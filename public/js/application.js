var datafile = new plupload.Uploader({
    browse_button: 'fileElem', // you can pass in id...
    drop_element: "dropzone",
    //chunk_size: '1mb',
    url: BASE_URL + '/uploadtoserver',


    //container: document.getElementById('container'), // ... or DOM Element itself
    //runtimes: 'html5,flash,silverlight,html4',
    //max_file_count: 1,
    multipart: true,


    //ADD FILE FILTERS HERE
    filters: {
        /* mime_types: [
                {title : "XML files", extensions : "xml"},
            ]
        */
    },

    // Flash settings
    flash_swf_url: BASE_URL + '/js/plupload/Moxie.swf',

    // Silverlight settings
    silverlight_xap_url: BASE_URL + '/js/plupload/Moxie.xap',



    init: {
        PostInit: function() {
            document.getElementById('upload').onclick = function() {
                datafile.start();
                console.log(datafile);
                datafile.refresh();
                return false;
            };
        },

        FilesAdded: function(up, files) {

            let newfiles = [];
            let submitdiv = document.getElementById('submitdiv')
            console.log(submitdiv);
            submitdiv.removeAttribute("style");

            // files.forEach(element => {
            //     console.log(element);
            //     newfiles.push(element);
            // });


            /************************ tableau *************************************/


            let myTable = document.querySelector('#table');
            let trHead = document.createElement('thead');
            trHead.id = "tableHeader"
            let headers = ['Nom', 'Détails', 'Taille', 'Durée', 'A transcrire', 'date du besoin', 'transfert', 'suppression'];
            let trheader = document.createElement('tr');

            trHead.appendChild(trheader);
            for (let j = 0; j < headers.length; j++) {
                let th = document.createElement('th'); //column
                let text = document.createTextNode(headers[j]); //cell
                th.appendChild(text);
                th.id = headers[j];
                th.setAttribute('scope', 'col')
                trheader.appendChild(th);

            }
            if (document.getElementById('tableHeader') === null) {


                myTable.appendChild(trHead);
            }
            document.getElementById('upload').style.display = 'none';

            //let rowtest = myTable.insertRow(0);
            /*****************************************************/
            console.log(files);
            let tbody = document.createElement('tbody');
            myTable.appendChild(tbody);

            plupload.each(files, function(file) {
                /********************************************** */
                let tr = document.createElement('tr');
                tr.id = "tr" + file.id;

                let fichiername = file.name;
                file['fichier'] = fichiername;


                let td1 = document.createElement('td');
                let titlefile = document.createElement('input');
                titlefile.type = 'text';
                td1.style.align = "center";
                td1.style.width = "100px";

                titlefile.value = file.name;
                titlefile.name = "upload[itmTitreLg1]";
                titlefile.id = 'titre' + file.fichier;
                titlefile.addEventListener('change', function() {
                    file.name = titlefile.value;
                    file['name'] = titlefile.value;
                    console.log(file);
                })


                file['details'] = "";
                let td2 = document.createElement('td');
                let details = document.createElement('textarea');
                details.id = "itmtxtxlientlg1";
                details.name = "upload[itmTxtClientlg1]";

                //ajout de la valeur du commentaires au file['details']
                //if (file['details'] != "") {
                details.addEventListener("change", function() {

                    file['details'] = details.value;
                    console.log(details.value);


                })
                console.log(file);


                let td4 = document.createElement('td');
                let taille = document.createElement('input');
                taille.type = "text";
                taille.id = "taille";
                taille.name = "upload[itmTaille]"
                taille.value = plupload.formatSize(file.size);
                file['taille'] = plupload.formatSize(file.size);
                //.substr(' ', plupload.formatSize(file.size).length - 3);
                //taille.disabled = true;

                let td5 = document.createElement('td');
                let durat = document.createElement('input');
                durat.type = "text";


                let td6 = document.createElement('td');
                let toTranscript = document.createElement('input');
                toTranscript.type = "checkbox";
                toTranscript.id = "itmatranscrire";
                toTranscript.disabled = true;
                //toTranscript.value = "false";
                if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {
                    toTranscript.checked = true;
                    toTranscript.value = "true";
                } else {
                    toTranscript.checked = false;
                    toTranscript.value = "false";
                }
                toTranscript.name = "upload[itmATranscrire]"
                if (toTranscript.checked === true) {
                    file['totranscript'] = "true";
                } else {
                    file['totranscript'] = "false";
                }

                const cdate = new Date();

                cdate.setMonth(cdate.getMonth() + 3);

                console.log(cdate);
                console.log(cdate.toLocaleDateString());


                let td7 = document.createElement('td');
                let deadline = document.createElement('input');
                deadline.type = "date";
                deadline.id = "itmdeadline"
                let currentDate = new Date();
                let futurDeadline = new Date(currentDate.setMonth(currentDate.getMonth() + 1)).toLocaleDateString();
                //console.log(futurDeadline)

                let day = currentDate.getDate(),
                    month = currentDate.getMonth() + 1,
                    year = currentDate.getFullYear(),
                    hour = currentDate.getHours(),
                    min = currentDate.getMinutes();

                month = (month < 10 ? "0" : "") + month;
                day = (day < 10 ? "0" : "") + day;
                hour = (hour < 10 ? "0" : "") + hour;
                min = (min < 10 ? "0" : "") + min;

                let deadLineDay = year + "-" + month + "-" + day;
                //let deadlineDate = futureDeadline.setDate(futureDeadline.getDate() + 1);
                //console.log(deadlineDate);
                deadline.value = deadLineDay;



                if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {
                    deadline.disabled = false;
                } else {
                    deadline.style.display = "none";
                }
                deadline.name = "upload[itmDeadlineRequise]";
                file['deadline'] = deadline.value;
                deadline.addEventListener('change', function() {
                    console.log(deadline.value);
                    file['deadline'] = deadline.value;
                });

                let td8 = document.createElement('td');
                let fichier = document.createElement('input');
                fichier.type = "text";
                fichier.id = "itmfichier";
                fichier.name = "upload[itmFichier]";

                let td9 = document.createElement('td');


                //affichage duréé si audio ou video ou image 
                let text4 = document.createTextNode(plupload.formatSize(file.size));
                if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {

                    //durat.disabled = true;
                    //td5.removeChild(durat);
                    text5 = durat;
                } else {
                    //let fontawe = document.createElement('p');
                    //fontawe.innerHTML = 'Image';
                    //fontawe.style.fontSize = '14px'
                    durat.value = "Image"
                    text5 = durat;

                }
                //let text5 = document.createTextNode("");
                //let text6 = document.createTextNode('<input type=\"checkbox\">');
                let text7 = document.createTextNode('Text4');
                //let text8 = document.createTextNode('<div class="progressbar"><div class="progress"></div>');
                //let text9 = document.createTextNode('<button id="' + file.id + file.name + '" class="removefile">X</button>');

                td1.style.width = '100px';

                let progression = document.createElement('div');
                progression.classList.add('progress', 'progress-sm', 'progress-half-rounded', 'm-none', 'mt-xs', 'light');
                progression.id = file.id + file.fichier;

                let progress = document.createElement('div');
                progress.classList.add('progress-bar', 'progress-bar', 'progress-bar-primary');
                let transfert = progression.appendChild(progress)

                let delFile = document.createElement('button');
                delFile.id = 'removefile' + file.id + file.fichier;
                delFile.classList.add('plupload_file_action');
                //delFile.classList.add('removefile');



                progression.style.width = '100px';

                td1.appendChild(titlefile);
                td2.appendChild(details);
                //td3.appendChild(text3);
                td4.appendChild(taille);
                td5.appendChild(text5);
                td6.appendChild(toTranscript);
                td7.appendChild(deadline);
                td8.appendChild(progression)
                td9.appendChild(delFile);


                tr.appendChild(td1);
                tr.appendChild(td2);
                //tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);
                progression.appendChild(progress);
                tr.appendChild(td9);

                tbody.appendChild(tr);


                /*-------------------------------*/
                /********************************************** */



                /***************************recuperation de la durée***************************/




                if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {
                    let audiotag = document.createElement('audio')
                    audiotag.id = 'audio' + file.id;

                    let obUrl;
                    if (file.fichier.match(/\.(avi|mp3|mp4|mpeg|ogg|mov|wmv|avchd|flv|f4v|swf|mkv|webm|html5|mpeg-2)$/i)) {
                        let blob = new Blob([file.getNative()], { type: typeof (file) });

                        obUrl = URL.createObjectURL(blob);

                        document.getElementById('audio').appendChild(audiotag);
                        document.getElementById('audio' + file.id).setAttribute('src', obUrl);
                        //document.getElementById('audio').appendChild(duratTime)
                        //console.log(document.getElementById('audio' + file.id));
                    }
                    let fileTo = document.getElementById('audio' + file.id);
                    if (fileTo) {
                        // store duration

                        document.getElementById('audio' + file.id).addEventListener('canplaythrough', function(e) {
                            //console.log('on lit la musique');// add duration in the input field #f_du
                            //console.log(e.currentTarget.duration);
                            f_duration = Math.round(e.currentTarget.duration);
                            //console.log(f_duration);
                            // document.getElementById('txt' + file.id).value = f_duration;
                            //document.getElementById(file.id).innerHTML += f_duration;
                            URL.revokeObjectURL(obUrl);
                            file['duration'] = f_duration;
                            file['duree'] = fancyTimeFormat(f_duration);

                            tdFTable3.innerHTML = file['duree'];
                            console.log(file['duree']);
                            console.log((file['duration'] / 60) * 1.99);

                            let minutDuration = file['duration'] / 60;
                            tdFTable5.innerHTML = toRound(minutDuration * 1.99, 2) + " €";

                            //console.log(f_duration);
                            durat.value = fancyTimeFormat(f_duration);

                        })

                    } else {
                        durat.value = "0";
                        file['duration'] = "0";
                        file['duree'] = "0"


                    }

                }
                file['percent'] = file.percent;






                /*--------------devis-----------------*/
                let Table = document.getElementById('table')
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");
                btn.style.marginRight = "50px";
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];


                let fTable = document.getElementById('fTable');
                console.log(fTable);
                let fTbody = document.getElementById('fTbody');
                console.log(fTbody);
                let trFTable = document.createElement('tr');
                trFTable.id = "tr" + file.id;
                let tdFTable1 = document.createElement('td');
                tdFTable1.id = file.id + 2;
                let tdFTable2 = document.createElement('td');
                let tdFTable3 = document.createElement('td');
                let tdFTable4 = document.createElement('td');
                let tdFTable5 = document.createElement('td');

                console.log(file);
                console.log(file.details);
                console.log(file.totranscript);
                console.log(file.taille);
                console.log(file.fichier);

                if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {


                    tdFTable2.innerHTML = file.fichier;
                    tdFTable4.innerHTML = "1.99€";



                    fTbody.appendChild(trFTable);
                    trFTable.appendChild(tdFTable1);
                    trFTable.appendChild(tdFTable2);
                    trFTable.appendChild(tdFTable3);
                    trFTable.appendChild(tdFTable4);
                    trFTable.appendChild(tdFTable5);

                    console.log(fTable.length);
                    for (let i = 1; i <= fTbody.rows.length; i++) {
                        tdFTable1.innerHTML = i;
                        console.log(i);
                    }
                    console.log(tdFTable1);
                }
                // When the user clicks the button, open the modal

                btn.onclick = function() {
                    console.log('modal');
                    modal.style.display = "block";
                    console.log(fTbody.rows.length);

                    // Update all indexes:
                    let nextIndex = 0;
                    Array.from(fTbody.children).forEach((row) => {
                        if (!row.hasAttribute('hidden')) {
                            // Only increment the counter for those that are not hidden;
                            row.children[0].textContent = ++nextIndex;
                        }
                    });

                    let httotal = document.createTextNode("");
                    let mttTva = document.createTextNode("");
                    let priceHT = document.createTextNode("");
                    let ttlTtc = document.createTextNode("");
                    let ttc = document.createTextNode("");
                    if (fTbody.rows.length > 1) {
                        console.log('la');
                        let ftablec = document.getElementById('fTable'), rIndex, cIndex
                        let tt = 0;

                        for (let i = 1; i < fTable.rows.length; i++) {

                            let price = parseFloat(ftablec.rows[i].cells[4].textContent);
                            if (isNaN(price)) {
                                console.log('nan');
                                price = 0
                                tt += price;
                                console.log(price + " " + tt);
                                //row cells

                                console.log(ftablec.rows[i].cells[4].textContent);
                            } else {
                                console.log('price is float')
                                tt += price;
                                console.log(price + " " + tt);
                                //row cells

                                console.log(ftablec.rows[i].cells[4].textContent);
                            }


                        }
                        if (document.getElementById('httotal').textContent.includes("Total HT : ")) {
                            console.log('text present');
                            document.getElementById('httotal').innerHTML = "";
                            document.getElementById('tva').innerHTML = "";
                            document.getElementById('httotal').innerHTML = "";
                            document.getElementById('ttctotal').innerHTML = "";

                        } httotal = document.createTextNode("Total HT : " + toRound(tt, 2) + " €");
                        file['ttHt'] = toRound(tt, 2);
                        document.getElementById('httotal').appendChild(httotal);
                        tttva = tt * 0.20;
                        file['tttva'] = tttva;
                        console.log(toRound(tttva, 2));

                        //tttva = toRound(tttva); console.log(tttva);
                        mttTva = document.createTextNode("Total TVA : " + toRound(tttva, 2) + " €");
                        file['mttTva'] = toRound(tttva, 2);
                        document.getElementById('tva').appendChild(mttTva);
                        priceHT = document.getElementById('httotal').innerHTML;
                        console.log(priceHT);
                        ttlTtc = tttva + tt;
                        ttc = document.createTextNode("Total TTC : " + toRound(parseFloat(ttlTtc), 2) + " €");
                        file['ttttc'] = toRound(parseFloat(ttlTtc), 2);
                        document.getElementById('ttctotal').appendChild(ttc);

                    }

                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                /*-------------------------------*/

                let myform = document.getElementById('form');
                let titre = 'input';




            });
            //let jsFile = JSON.stringify(files);
            /*--------------removefile-----------------*/
            if (document.getElementById('upload').style.display != "hidden") {


                let index, table = document.getElementById('table');
                let fTable = document.getElementById('fTable');
                console.log(files);
                for (let i = 1; i < table.rows.length; i++) {

                    table.rows[i].cells[7].onclick = function() {
                        index = this.parentElement.rowIndex;

                        let deletedFileid = table.rows[index].id;
                        console.log(deletedFileid);
                        let row = document.getElementById(deletedFileid);
                        console.log(row);
                        if (row) {
                            console.log(row);
                            row.remove();
                        }
                        console.log(table.rows[index].cells[0].innerHTML);
                        table.deleteRow(index);
                        files.splice(index - 1, 1);
                        datafile.splice(index - 1, 1);
                        console.log(index);
                        console.log(files);
                        //table.refresh();

                        /********************Update row[o] table estimate*********************/

                    };

                    datafile.refresh();

                }

            }

            document.getElementById('upload').addEventListener('click', function() {

                console.log('test on click #upload');
                /********************Desactivation bouton envoyer activation bouton refresh************************** */
                document.getElementById('upload').style.display = 'none';

                //désactivation de tout les inputs
                let allInput = document.getElementsByTagName('input');
                for (const input of allInput) {
                    input.disabled = true
                }
                console.log(files);
                files.forEach(element => {

                    document.getElementById('removefile' + element.id + element.fichier).style.display = "none";
                });
                let refreshButton = document.createElement('a');
                refreshButton.id = "clearpage";
                refreshButton.href = BASE_URL + "/home";
                refreshButton.textContent = "Rafraichir";
                document.getElementById('myBtn').after(refreshButton);
                /**********************************multiple files**********************************/
                //appel de la nouvelle action qui est dans le controller
                //recupere les données du form et faire une requete ajax avec celui la


                let xhr = new XMLHttpRequest();
                let formData = new FormData();
                let formData2 = new FormData();
                for (let fileToSave of files) {
                    formData.append("myFiles[]", JSON.stringify(fileToSave));
                    formData2.append("test[]", fileToSave);
                    console.log(JSON.stringify(fileToSave));
                    console.log(fileToSave);
                }
                console.log(formData2);
                console.log(formData);
                xhr.open("post", "/home/ajout");
                xhr.send(formData, formData2);

            });
            /**********************validation devis**************************/
            document.getElementById('estimate-accepted').addEventListener('click', function() {
                document.getElementById('upload').style.display = 'inline';
                document.getElementById('myBtn').style.marginRight = 'auto';
                document.getElementById('myModal').style.display = 'none';
                document.getElementById('dz').style.display = 'none';
            });
            /**********************refus devis**************************/
            document.getElementById('estimate-decline').addEventListener('click', function() {
                document.getElementById('myModal').style.display = 'none';
                document.getElementById('myBtn').style.marginRight = 'auto';

            });

        },

        UploadProgress: function(up, file) {


            //traitement de la barre de progression

            let progcolor = document.getElementById(file.id + file.fichier).querySelector('.progress-bar');
            //console.log(progcolor);
            progcolor.style.width = file.percent + '%';
            progcolor.style.background = 'background: linear - gradient(to right, green, #008550)';
            file['percent'] = file.percent;
            progcolor.innerHTML = file.percent;



        },

        Error: function(up, err) {
            // if (err.code === -600) {
            // 	document.getElementById('console').innerHTML += "votre fichier semble corrompu veuillez vérifier l\'état de";
            // }
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        },


    }
});


datafile.init();
datafile.refresh();
function toRound(value, digits) {
    let factor = Math.pow(10, digits);
    //we need to multiply the value by the power of ten, then round it, and then divide it again by the same power of ten.
    value += Math.sign(value) * Number.EPSILON;
    return Math.round(value * factor) / factor;
}
function getExtension(filename) {
    return filename.substring(filename.lastIndexOf(".") + 1);
}
function removeExtension(filename) {
    return filename.substring(0, filename.lastIndexOf('.')) || filename;
}
function fancyTimeFormat(duration) {
    // Hours, minutes and seconds
    var hrs = ~~(duration / 3600);
    var mins = ~~((duration % 3600) / 60);
    var secs = ~~duration % 60;

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";

    if (hrs > 0) {
        ret += "" + hrs + " h " + (mins < 10 ? "0" : "");
    }

    ret += "" + mins + " min " + (secs < 10 ? "0" : "");
    ret += "" + secs + " sec ";
    return ret;
}

