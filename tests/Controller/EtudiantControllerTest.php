<?php

namespace App\Test\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EtudiantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EtudiantRepository $repository;
    private string $path = '/etudiant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Etudiant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Etudiant index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'etudiant[numetd]' => 'Testing',
            'etudiant[nom]' => 'Testing',
            'etudiant[prenom]' => 'Testing',
            'etudiant[email]' => 'Testing',
            'etudiant[sexe]' => 'Testing',
            'etudiant[adresse]' => 'Testing',
            'etudiant[tel]' => 'Testing',
            'etudiant[datnaiss]' => 'Testing',
            'etudiant[depnaiss]' => 'Testing',
            'etudiant[villnaiss]' => 'Testing',
            'etudiant[paysnaiss]' => 'Testing',
            'etudiant[nationalite]' => 'Testing',
            'etudiant[sports]' => 'Testing',
            'etudiant[handicape]' => 'Testing',
            'etudiant[derdiplome]' => 'Testing',
            'etudiant[dateinsc]' => 'Testing',
            'etudiant[registre]' => 'Testing',
            'etudiant[statut]' => 'Testing',
            'etudiant[groupe]' => 'Testing',
            'etudiant[resultatbac]' => 'Testing',
        ]);

        self::assertResponseRedirects('/etudiant/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Etudiant();
        $fixture->setNumetd('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setTel('My Title');
        $fixture->setDatnaiss('My Title');
        $fixture->setDepnaiss('My Title');
        $fixture->setVillnaiss('My Title');
        $fixture->setPaysnaiss('My Title');
        $fixture->setNationalite('My Title');
        $fixture->setSports('My Title');
        $fixture->setHandicape('My Title');
        $fixture->setDerdiplome('My Title');
        $fixture->setDateinsc('My Title');
        $fixture->setRegistre('My Title');
        $fixture->setStatut('My Title');
        $fixture->setGroupe('My Title');
        $fixture->setResultatbac('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Etudiant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Etudiant();
        $fixture->setNumetd('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setTel('My Title');
        $fixture->setDatnaiss('My Title');
        $fixture->setDepnaiss('My Title');
        $fixture->setVillnaiss('My Title');
        $fixture->setPaysnaiss('My Title');
        $fixture->setNationalite('My Title');
        $fixture->setSports('My Title');
        $fixture->setHandicape('My Title');
        $fixture->setDerdiplome('My Title');
        $fixture->setDateinsc('My Title');
        $fixture->setRegistre('My Title');
        $fixture->setStatut('My Title');
        $fixture->setGroupe('My Title');
        $fixture->setResultatbac('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'etudiant[numetd]' => 'Something New',
            'etudiant[nom]' => 'Something New',
            'etudiant[prenom]' => 'Something New',
            'etudiant[email]' => 'Something New',
            'etudiant[sexe]' => 'Something New',
            'etudiant[adresse]' => 'Something New',
            'etudiant[tel]' => 'Something New',
            'etudiant[datnaiss]' => 'Something New',
            'etudiant[depnaiss]' => 'Something New',
            'etudiant[villnaiss]' => 'Something New',
            'etudiant[paysnaiss]' => 'Something New',
            'etudiant[nationalite]' => 'Something New',
            'etudiant[sports]' => 'Something New',
            'etudiant[handicape]' => 'Something New',
            'etudiant[derdiplome]' => 'Something New',
            'etudiant[dateinsc]' => 'Something New',
            'etudiant[registre]' => 'Something New',
            'etudiant[statut]' => 'Something New',
            'etudiant[groupe]' => 'Something New',
            'etudiant[resultatbac]' => 'Something New',
        ]);

        self::assertResponseRedirects('/etudiant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNumetd());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getSexe());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getTel());
        self::assertSame('Something New', $fixture[0]->getDatnaiss());
        self::assertSame('Something New', $fixture[0]->getDepnaiss());
        self::assertSame('Something New', $fixture[0]->getVillnaiss());
        self::assertSame('Something New', $fixture[0]->getPaysnaiss());
        self::assertSame('Something New', $fixture[0]->getNationalite());
        self::assertSame('Something New', $fixture[0]->getSports());
        self::assertSame('Something New', $fixture[0]->getHandicape());
        self::assertSame('Something New', $fixture[0]->getDerdiplome());
        self::assertSame('Something New', $fixture[0]->getDateinsc());
        self::assertSame('Something New', $fixture[0]->getRegistre());
        self::assertSame('Something New', $fixture[0]->getStatut());
        self::assertSame('Something New', $fixture[0]->getGroupe());
        self::assertSame('Something New', $fixture[0]->getResultatbac());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Etudiant();
        $fixture->setNumetd('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setTel('My Title');
        $fixture->setDatnaiss('My Title');
        $fixture->setDepnaiss('My Title');
        $fixture->setVillnaiss('My Title');
        $fixture->setPaysnaiss('My Title');
        $fixture->setNationalite('My Title');
        $fixture->setSports('My Title');
        $fixture->setHandicape('My Title');
        $fixture->setDerdiplome('My Title');
        $fixture->setDateinsc('My Title');
        $fixture->setRegistre('My Title');
        $fixture->setStatut('My Title');
        $fixture->setGroupe('My Title');
        $fixture->setResultatbac('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/etudiant/');
    }
}
