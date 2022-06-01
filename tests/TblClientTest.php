<?php

namespace App\Tests;

use App\Entity\Tblclient;
use PHPUnit\Framework\TestCase;


class TblClientTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new Tblclient();

        $user->setPassword('password')
            ->setClientLogin('Login')
            ->setClientTxtLg1('Client text lg 1')
            ->setClientImg('img')
            ->setClientFichier('fichier')
            ->setClientNom('Nom')
            ->setClientPrenom('Prenom')
            ->setClientTitre('Titre')
            ->setClientAdresse('adresse test 1')
            ->setClientAdresse2('adresse test 2')
            ->setClientCP('57070')
            ->setClientVille('Metz')
            ->setClientPays('France')
            ->setClientMail('true@test.com')
            ->setClientTel('0606060606')
            ->setClientTel2('0606060607')
            ->setClientPseudo('Pseudo')
            ->setClientToken('Token');


        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getClientLogin() === 'Login');
        $this->assertTrue($user->getClientTxtLg1() === 'Client text lg 1');
        $this->assertTrue($user->getClientImg() === 'img');
        $this->assertTrue($user->getClientFichier() === 'fichier');
        $this->assertTrue($user->getClientNom() === 'Nom');
        $this->assertTrue($user->getClientPrenom() === 'Prenom');
        $this->assertTrue($user->getClientTitre() === 'Titre');
        $this->assertTrue($user->getClientAdresse() === 'adresse test 1');
        $this->assertTrue($user->getClientAdresse2() === 'adresse test 2');
        $this->assertTrue($user->getClientCP() === '57070');
        $this->assertTrue($user->getClientVille() === 'Metz');
        $this->assertTrue($user->getClientPays() === 'France');
        $this->assertTrue($user->getClientMail() === 'true@test.com');
        $this->assertTrue($user->getClientTel() === '0606060606');
        $this->assertTrue($user->getClientTel2() === '0606060607');
        $this->assertTrue($user->getClientPseudo() === 'Pseudo');
        $this->assertTrue($user->getClientToken() === 'Token');
    }
    public function testIsFalse()
    {
        $user = new Tblclient();

        $user->setPassword('password')
        ->setClientLogin('Login')
        ->setClientTxtLg1('Client text lg 1')
        ->setClientImg('img')
        ->setClientFichier('fichier')
        ->setClientNom('Nom')
        ->setClientPrenom('Prenom')
        ->setClientTitre('Titre')
        ->setClientAdresse('adresse test 1')
        ->setClientAdresse2('adresse test 2')
        ->setClientCP('57070')
        ->setClientVille('Metz')
        ->setClientPays('France')
        ->setClientMail('true@test.com')
        ->setClientTel('0606060606')
        ->setClientTel2('0606060607')
        ->setClientPseudo('Pseudo')
        ->setClientToken('Token');

        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getClientLogin() === 'false');
        $this->assertFalse($user->getClientTxtLg1() === 'false');
        $this->assertFalse($user->getClientImg() === 'false');
        $this->assertFalse($user->getClientFichier() === 'false');
        $this->assertFalse($user->getClientNom() === 'false');
        $this->assertFalse($user->getClientPrenom() === 'false');
        $this->assertFalse($user->getClientTitre() === 'false');
        $this->assertFalse($user->getClientAdresse() === 'false');
        $this->assertFalse($user->getClientAdresse2() === 'false');
        $this->assertFalse($user->getClientCP() === 'false');
        $this->assertFalse($user->getClientVille() === 'false');
        $this->assertFalse($user->getClientPays() === 'false');
        $this->assertFalse($user->getClientMail() === 'false@test.com');
        $this->assertFalse($user->getClientTel() === 'false');
        $this->assertFalse($user->getClientTel2() === 'false');
        $this->assertFalse($user->getClientPseudo() === 'false');
        $this->assertFalse($user->getClientToken() === 'false');
    }
    public function testIsEmpty()
    {
        $user = new Tblclient();

       
        $this->assertEmpty($user->getClientLogin());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getClientTxtLg1());
        $this->assertEmpty($user->getClientImg());
        $this->assertEmpty($user->getClientFichier());
        $this->assertEmpty($user->getClientNom());
        $this->assertEmpty($user->getClientPrenom());
        $this->assertEmpty($user->getClientTitre());
        $this->assertEmpty($user->getClientAdresse());
        $this->assertEmpty($user->getClientAdresse2());
        $this->assertEmpty($user->getClientCP());
        $this->assertEmpty($user->getClientVille());
        $this->assertEmpty($user->getClientPays());
        $this->assertEmpty($user->getClientMail());
        $this->assertEmpty($user->getClientTel());
        $this->assertEmpty($user->getClientTel2());
        $this->assertEmpty($user->getClientPseudo());
        $this->assertEmpty($user->getClientToken());
    }
}
