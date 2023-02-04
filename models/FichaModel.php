<?php
namespace Models;
class FichaModel {
    function load() {

    }

    function getVars() {
        $playerExists = in_array('ordemdocaos', $_SESSION['rpg-list']);
        $vars = [
            'playerExists' => $playerExists
        ];
        if ($playerExists) {
            foreach ($_SESSION['ordemdocaos'] as $key => $value) {
                $vars[$key] = $value;
            }
        }
        return $vars;
    }

    function createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento, 
        $jogador, $exposicao, $origem, $trilha, $pe, $imagem, $vida, $energia, $stamina) 
    {
        $maxVida = $vida;
        $maxEnergia = $energia;
        $maxStamina = $stamina;
        try {
            $fields = [
                $userId,
                $nome,
                $classe,
                $idade,
                $nacionalidade,
                $deslocamento,
                $jogador,
                $exposicao,
                $origem,
                $trilha,
                $pe,
                $imagem,
                $vida,
                $maxVida,
                $energia,
                $maxEnergia,
                $stamina,
                $maxStamina
            ];
            foreach ($fields as $value) {
                if (empty($value)) {
                    return 'Nenhum campo pode ficar vazio.';
                }
            }
            if (empty($imagem)) {
                return 'Você precisa selecionar uma imagem.';
            }

            if (in_array('ordemdocaos', $_SESSION['rpg-list'])) {
                return 'Você já participa dessa mesa.';
            }

            $sql = \MySQL::connect()->prepare('INSERT INTO `tb_rpg.ordemdocaos.players` 
            (id, user_id, nome, classe, idade, nacionalidade, deslocamento, jogador, exposicao,
            origem, trilha, pe, imagem, vida, max_vida, energia, max_energia, stamina, max_stamina)
            VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $sql->execute($fields);
            array_push($_SESSION['rpg-list'], 'ordemdocaos');

            $_SESSION['ordemdocaos']['user_id'] = $userId;
            $_SESSION['ordemdocaos']['nome'] = $nome;
            $_SESSION['ordemdocaos']['classe'] = $classe;
            $_SESSION['ordemdocaos']['idade'] = $idade;
            $_SESSION['ordemdocaos']['nacionalidade'] = $nacionalidade;
            $_SESSION['ordemdocaos']['deslocamento'] = $deslocamento;
            $_SESSION['ordemdocaos']['jogador'] = $jogador;
            $_SESSION['ordemdocaos']['exposicao'] = $exposicao;
            $_SESSION['ordemdocaos']['origem'] = $origem;
            $_SESSION['ordemdocaos']['trilha'] = $trilha;
            $_SESSION['ordemdocaos']['pe'] = $pe;
            $_SESSION['ordemdocaos']['imagem'] = $imagem;
            $_SESSION['ordemdocaos']['vida'] = $vida;
            $_SESSION['ordemdocaos']['max_vida'] = $maxVida;
            $_SESSION['ordemdocaos']['energia'] = $energia;
            $_SESSION['ordemdocaos']['max_energia'] = $maxEnergia;
            $_SESSION['ordemdocaos']['stamina'] = $stamina;
            $_SESSION['ordemdocaos']['max_stamina'] = $maxStamina;

            return 'Sucesso';   
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }
}
?>