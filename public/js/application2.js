var datafile = new plupload.Uploader({
	runtimes: 'html5,flash,silverlight,html4',
	browse_button: 'fileElem', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	drop_element: "drop-area",
	chunk_size: '1mb',
	url: BASE_URL + '/uploadtoserver',
	max_file_count: 1,
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
			//console.log(url);
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('upload').onclick = function() {
				console.log(datafile);
				datafile.start();
				//datafile.refresh();
				return false;
			};
		},

		FilesAdded: function(up, files) {

			files.forEach(element => {
				console.log(element);

			});
			/************************ tableau *************************************/


			let myTable = document.querySelector('#table');
			let trHead = document.createElement('thead');
			let headers = ['Nom', 'Detail', 'Date', 'Taille', 'Durée', 'A transcrire', 'date du besoin', 'transfert', 'suppression'];





			for (let j = 0; j < headers.length; j++) {
				let th = document.createElement('th'); //column
				let text = document.createTextNode(headers[j]); //cell
				th.appendChild(text);
				trHead.appendChild(th);
			}

			myTable.appendChild(trHead);

			//let rowtest = myTable.insertRow(0);
			/*****************************************************/


			let divDur = document.createElement('div');

			console.log(files);
			// let input1 = document.getElementById('fileinput');
			// console.log(files);
			// let freader = new FileReader();
			// freader.readAsDataURL(input1.files[0]);
			// freader.onabort, laod = function() {
			// 	alert(freader.result)
			// }

			plupload.each(files, function(file) {
				let spanDur = document.createElement('span');
				console.log(file);
				console.log(file.getNative());
				console.log(file.getSource());
				let filename = file.name;
				// if (filename.substring(filename.lastIndexOf(".") + 1) === "mkv") {
				// 	alert('format mkv');
				// 	filename.replace(file);
				// 	let filenamewext = removeExtension(filename);
				// 	file.name = filenamewext + '.avi';
				// 	console.log(file.name);
				// }
				// let test = plupload.Uploader.getFile(file.id);
				// console.log(test);



				/********************************************** */

				/*-------------------------------*/
				//.removefile
				//document.querySelector('.removefile').addEventListener('click', plupload.removeFile(file));

				/*-------------------------------*/
				let tbody = document.createElement('tbody');
				myTable.appendChild(tbody);


				let tr = document.createElement('tr');
				let details = document.createElement('textarea');
				details.id = "itmtxtxlientlg1";
				details.name = "upload[itmtxtxlientlg1]";
				details.required = "required";
				let toTranscript = document.createElement('input');
				toTranscript.type = "checkbox";
				let progression = document.createElement('div');
				progression.classList.add('progressbar');
				progression.id = file.id + file.name;

				let progress = document.createElement('div');
				progress.classList.add('progress');
				let transfert = progression.appendChild(progress)

				let delFile = document.createElement('button');
				delFile.id = file.id + file.name;
				delFile.classList.add('removefile');

				let durat = document.createElement('input');
				durat.type = "text";
				durat.value = file['duration'];
				durat.classList.add('duration');



				//console.log(Object.values(file.duration));

				let td1 = document.createElement('td');
				let td2 = document.createElement('td');
				let td3 = document.createElement('td');
				let td4 = document.createElement('td');
				let td5 = document.createElement('td');


				let td6 = document.createElement('td');
				let td7 = document.createElement('td');
				let td8 = document.createElement('td');
				let td9 = document.createElement('td');

				let text1 = document.createTextNode(file.name);
				//let text2 = document.createTextNode('<textarea id="itmtxtclientlg1" name="upload[itmTxtClientLg1]" required="required"></textarea>');
				let text3 = document.createTextNode(new Date().toISOString().slice(0, 10));
				let text4 = document.createTextNode(plupload.formatSize(file.size));
				//let text5 = document.createTextNode("");
				//let text6 = document.createTextNode('<input type=\"checkbox\">');
				let text7 = document.createTextNode('Text4');
				//let text8 = document.createTextNode('<div class="progressbar"><div class="progress"></div>');
				//let text9 = document.createTextNode('<button id="' + file.id + file.name + '" class="removefile">X</button>');

				td1.appendChild(text1);
				td2.appendChild(details);
				td3.appendChild(text3);
				td4.appendChild(text4);
				td5.appendChild(durat);
				td6.appendChild(toTranscript);
				td7.appendChild(text7);
				td8.appendChild(progression)
				td9.appendChild(delFile);

				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td3);
				tr.appendChild(td4);
				tr.appendChild(td5);
				tr.appendChild(td6);
				tr.appendChild(td7);
				tr.appendChild(td8);
				progression.appendChild(progress);
				tr.appendChild(td9);

				tbody.appendChild(tr);

				/*-------------------------------*/

				/***************************recuperation de la durée***************************/
				console.log(file.type);

				//let blob = new Blob([file.getNative()], { type: typeof (file) });
				// let duration = "";
				// window.URL = window.URL || window.webkitURL;
				// if (file.type.startsWith("audio/")) {
				// 	console.log('c\'est de l\'audio');
				// 	var audio = document.createElement('audio');
				// 	audio.id = 'audio' + file.id;
				// 	audio.preload = 'metadata';
				// 	audio.onloadedmetadata = function() {
				// 		//document.getElementById('audio' + file.id).setAttribute('src', obUrl);
				// 		window.URL.revokeObjectURL(audio.src);
				// 		console.log("Duration : " + fancyTimeFormat(audio.duration));
				// 		file['duration'] = audio.duration;
				// 		duration += audio.duration;
				// 	}
				// 	audio.src = URL.createObjectURL(blob);

				// } else if (file.type.startsWith("video/")) {
				// 	console.log('c\'est une video')
				// 	var video = document.createElement('video');
				// 	video.id = 'video' + file.id;
				// 	video.preload = 'metadata';
				// 	video.onloadedmetadata = function() {
				// 		//document.getElementById('video' + file.id).setAttribute('src', obUrl);
				// 		window.URL.revokeObjectURL(video.src);
				// 		file['duration'] = video.duration;
				// 		console.log("Duration : " + fancyTimeFormat(video.duration));
				// 		//file['duration'] = video.duration;
				// 		duration += video.duration;
				// 	}
				// 	video.src = URL.createObjectURL(blob);

				// }

				/*******************recuperation de la durée****************************/

				console.log(file['duration']);


				if (file.type.startsWith("audio/") || file.type.startsWith("video/")) {
					let audiotag = document.createElement('audio')
					audiotag.id = 'audio' + file.id;
					let duratTime = document.createElement('input');
					duratTime.setAttribute('type', 'text');
					duratTime.setAttribute('id', 'txt' + file.id);
					let duration = "";
					let obUrl;
					console.log(file);
					if (file.name.match(/\.(avi|mp3|mp4|mpeg|ogg|mov|wmv|avchd|flv|f4v|swf|mkv|webm|html5|mpeg-2)$/i)) {
						let blob = new Blob([file.getNative()], { type: typeof (file) });

						obUrl = URL.createObjectURL(blob);

						document.getElementById('audio').appendChild(audiotag);
						document.getElementById('audio' + file.id).setAttribute('src', obUrl);
						document.getElementById('audio').appendChild(duratTime)
						//console.log(document.getElementById('audio' + file.id));
					}

					// store duration
					//console.log(document.getElementById('audio' + file.id));
					document.getElementById('audio' + file.id).addEventListener('canplaythrough', function(e) {
						console.log('on lit la musique');// add duration in the input field #f_du
						console.log(e.currentTarget.duration);
						f_duration = Math.round(e.currentTarget.duration);
						console.log(f_duration);
						document.getElementById('txt' + file.id).value = f_duration;
						//document.getElementById(file.id).innerHTML += f_duration;
						URL.revokeObjectURL(obUrl);
						file['duration'] = f_duration;

						console.log(f_duration);
						durat.value = fancyTimeFormat(f_duration);



					})
				}

				if (!file.type.startsWith("audio/") || !file.type.startsWith("video/")) {

					durat.disabled = true;
					td5.removeChild(durat);
					let fontawe = document.createElement('p');
					fontawe.innerHTML = 'Image';
					fontawe.style.fontSize = '14px'
					td5.appendChild(fontawe);
				} else if (durat.value === "undefined") {
					durat.value = 'test';
				}

				// } else if (file.type.startsWith("video/")) {
				// 	let videotag = document.createElement('audio')
				// 	videotag.id = 'audio' + file.id;
				// 	let duratTime = document.createElement('input');
				// 	duratTime.setAttribute('type', 'text');
				// 	duratTime.setAttribute('id', 'txt' + file.id);
				// 	let obUrl;
				// 	console.log(file);
				// 	if (file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)) {
				// 		let blob = new Blob([file.getNative()], { type: typeof (file) });

				// 		obUrl = URL.createObjectURL(blob);

				// 		document.getElementById('audio').appendChild(videotag);
				// 		document.getElementById('audio' + file.id).setAttribute('src', obUrl);
				// 		document.getElementById('audio').appendChild(duratTime)
				// 		console.log(document.getElementById('audio' + file.id));
				// 	}

				// 	let f_duration = 0; // store duration
				// 	console.log(document.getElementById('audio' + file.id));
				// 	document.getElementById('audio' + file.id).addEventListener('canplaythrough', function(e) {
				// 		console.log('on lit la musique');// add duration in the input field #f_du
				// 		console.log(e.currentTarget.duration);
				// 		f_duration = Math.round(e.currentTarget.duration);
				// 		console.log(f_duration);
				// 		document.getElementById('txt' + file.id).value = f_duration;
				// 		//document.getElementById(file.id).innerHTML += f_duration;
				// 		URL.revokeObjectURL(obUrl);
				// 	})
				// }

				/********************************************** */
				// let x = getExtension(file.name);
				// let date = new Date();


				// let fileRow = document.createElement('tr');
				// tableBody.appendChild(fileRow);
				// console.log(files);
				// let cell = document.createElement('td');
				// //fileRow.appendChild(cell);
				// fileRow.innerHTML += '<td><input type="text" id="titre" name="upload[itmTitreLg1]" value="' + file.name + '" required="required" disabled="disabled"></td>' + '<td><textarea id="itmtxtclientlg1" name="upload[itmTxtClientLg1]" required="required"></textarea></td>' + '<td><input type=""> </td>' + '<td>' + plupload.formatSize(file.size) + ' ' + x + '</td><td>' + file.name % 60 + '</td><td>' + '<input type=\"checkbox\"></td>' + '</td><td>' + '<input type=\"checkbox\"></td><td><div class="progressbar"><div class="progress"></div></td><td><button id="' + file.id + file.name + '" class="removefile">X</button></td>';


				// document.getElementById('tablelist').innerHTML += '<tr id="' + file.id + '" class=table>' + '<td>' + file.name + '</td>' + '<td>' + plupload.formatSize(file.size) + '</td></tr>'
				//document.getElementById('filelist').innerHTML += '<div id="' + file.id + '"class="file">' + file.name + ' (' + plupload.formatSize(file.size) + ')' + '<div class="progressbar"><div class="progress"> </div></div><button id="' + file.id + file.name + '" class="removefile">X</button></div>';
				// document.getElementById('titre').value = file.name;
				// let titre = '<fieldset disabled="disabled"><div class="col"><label for="upload_itmTitreLg1" class="required">titre</label><input type="text" id="titre" name="upload[itmTitreLg1]" value="' + file.name + '" required="required"></div > </fieldset>'
				// let details = '<div class="col" ><label for="upload_itmTxtClientLg1" class="required">Détails</label><textarea id="itmtxtclientlg1" name="upload[itmTxtClientLg1]" required="required"></textarea></div>'


				let myform = document.getElementById('form');
				let titre = 'input';
				// document.getElementById('titre').value = file.name;
				// document.getElementById('itmtaille').value = plupload.formatSize(file.size).substr(' ', plupload.formatSize(file.size).length - 3);
				file['test'] = 1;


			});
			console.log(files);
			//myTable.appendChild(table);
			// let myform = document.getElementById('uploadform')
			// document.getElementById('upload').addEventListener('click', function() {
			// 	console.log('test on click #upload');
			// 	myform.click();
			// })
		},

		UploadProgress: function(up, file) {
			//console.log(file);
			//document.getElementById(file.id).getElementsByClassName('progress')[0].innerHTML = '<span>' + file.percent + '%</span>';
			//filerow.innerHTML = file.percent;

			//traitement de la barre de progression				
			let uploadedfile = [file.id];
			uploadedfile.push(file.id);
			// uploadedfile.forEach(function(element) {
			// 	console.log(element);
			// 	let divfile = document.getElementById(element.id).getElementsByClassName('progress');
			// 	console.log(divfile);
			// 	divfile.style.width = element.percent + '%';
			// })
			let progcolor = document.getElementById(file.id + file.name).querySelector('.progress');
			progcolor.style.width = file.percent / 25 + '%';
			progcolor.style.background = 'background: linear - gradient(to right, green, #008550)';

			//console.log(progcolor.style);

		},

		Error: function(up, err) {
			// if (err.code === -600) {
			// 	document.getElementById('console').innerHTML += "votre fichier semble corrompu veuillez vérifier l\'état de";
			// }
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		},
		// RemoveFile: function(file) {
		// 	let delbutton = document.getElementById(file.id).querySelector('.removefile');
		// 	console.log(delbutton);
		// 	delbutton.addEventListener('click', function() {
		// 		console.log('test de suppresion');
		// 	})
		// }


	}
});

datafile.init();

function deleteFile(file) {

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
// function getDuration(control) {
// 	var video = document.createElement('video');
// 	console.log(control.files);
// 	video.preload = 'metadata';
// 	video.onloadedmetadata = function() {
// 		window.URL.revokeObjectURL(video.src);
// 		alert("Duration : " + video.duration + " seconds");
// 	}
// 	let binaryData = [];
// 	binaryData.push(control.files[0]);

// 	video.src = URL.createObjectURL(new File([""], control.name, {
// 		type: control.type,
// 	}))
// 	URL.createObjectURL(control.files[0]);
// }

