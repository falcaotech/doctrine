<?php

namespace JRP\Produto\Service;

use Doctrine\ORM\EntityManager;
use JRP\Produto\Entity\Produto;
use JRP\Util\MoneyFormatter;

class ProdutoService {

    use MoneyFormatter;

    private $produto;

    public function __construct(EntityManager $em, Produto $produto)
    {
        $this->em = $em;
        $this->produto = $produto;
    }

    public function read($id = null)
    {
        $repo = $this->em->getRepository("JRP\Produto\Entity\Produto");

        return is_null($id) ? $repo->findAll() : $repo->find($id);
    }

    public function insert(array $data = array())
    {
        $this->produto->setNome($data['nome']);
        $this->produto->setValor($this->stringToMoney($data['valor']));
        $this->produto->setDescricao($data['descricao']);

        try {
            $this->em->persist($this->produto);
            $this->em->flush();
        } catch(\Exception $error) {
            return [
                'success' => false,
                'msg' => 'Erro ao inserir produto!'
            ];
        }

        return [
            'success' => true,
            'msg' => 'Produto inserido com sucesso!',
            'produto' => [
                'id' => $this->produto->getId()
            ]
        ];
    }

    public function update(array $data = array())
    {
        $id = $data['id'];

        $entity = $this->read($id);

        $entity->setNome($data['nome']);
        $entity->setDescricao($data['descricao']);
        $entity->setValor($this->stringToMoney($data['valor']));

        $this->em->merge($entity);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto atualizado com sucesso!'
        ];
    }

    /*
     * Criei esta coluna updateColumn() para que ela trabalhe com o xEditable + DataTable através
     * da requisição ajax em tempo real.
     * O xEditable é aquele editor de colunas da tabela que estou usando no front-end, onde você
     * clica em uma coluna da linha e altera seu respectivo valor.
     *
     * Como o xEditor trabalha com apenas uma coluna por vez, tive que criar esse método separadamente
     * para verificar qual coluna que será atualizada e chamar o método correspondente da entidade.
     *
     * O xEditor envia 3 valores por Ajax (POST), são eles:
     *
     * pk => ID do registro.
     * name => NOME da Coluna.
     * value => NOVO valor.
     *
     * Espero que tenha dado para atender porque fiz este método separado.
     * É um método que altera os dados da entidade dinamicamente conforme a coluna recebida pelo xEditor.
     */
    public function updateColumn(array $data = array())
    {
        $id = (int) $data['pk'];

        $column = $data['name'];

        if($column == 'valor')
        {
            // A coluna que será alterada é a do valor do produto, logo, formatar o mesmo.
            $data['value'] = $this->stringToMoney($data['value']);
        }

        $entity = $this->read($id);
        $entity->{"set".ucfirst($column)}($data['value']);

        $this->em->merge($entity);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto atualizado com sucesso!'
        ];
    }

    public function delete($id)
    {
        $this->produto->setId((int) $id);

        $produto = $this->read($this->produto->getId());

        if(!$produto)
        {
            throw new \Exception("Produto ID: {$produto->getId()} não encontrado");
        }

        $this->em->remove($produto);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto excluído com sucesso!'
        ];
    }

} 