<?php

namespace nrv\infrastructure\repositories;

use nrv\core\domain\entities\spectacle\Spectacle;
use nrv\core\repositoryException\RepositoryEntityNotFoundException;
use nrv\core\repositoryException\RepositoryException;
use nrv\core\repositroryInterfaces\SoireesRepositoryInterface;

class PDOSoireeRepository implements SoireesRepositoryInterface{

    private \PDO $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getAllSpectacles(): array{
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM spectacles');
            $stmt->execute();
            $spectacles = $stmt->fetch();
            if( !$spectacles){
                throw new RepositoryEntityNotFoundException('pas de spectacle');
            }
            $specTab = [];
            foreach ($spectacles as $spe){
                $specEntity = new Spectacle($spe['titre'],$spe['description'],$spe['h'],$spe['url_video']);
                $specEntity->setID($spe['id']);
                $specTab[]=$specEntity;
            }
            return $specTab;

        }catch (\Exception $e){
            throw new RepositoryException('erreur lors du chargement des lists');
        }
    }

    public function getSpectacleByIdSoiree($idSoiree): array{
        return [];
    }
}