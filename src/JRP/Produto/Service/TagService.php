<?php

namespace JRP\Produto\Service;

use Doctrine\ORM\EntityManager;
use JRP\Produto\Entity\Tags;

class TagService {

    public function __construct(EntityManager $em, Tags $tag)
    {
        $this->em = $em;
        $this->tag = $tag;
    }

    public function insert(array $data = array())
    {
        try {
            $this->tag->setNome($data['nome']);
            $this->em->persist($this->tag);
            $this->em->flush();
        } catch(\Exception $error) {
            return [
                'success' => false,
                'msg' => 'Erro ao inserir tag!'
            ];
        }

        return [
            'success' => true,
            'msg' => 'Tag inserida com sucesso!',
            'tag' => [
                'id' => $this->tag->getId()
            ]
        ];
    }

} 