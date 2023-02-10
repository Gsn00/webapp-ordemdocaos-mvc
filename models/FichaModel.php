<?php
namespace Models;
class FichaModel extends Model {

    function load() {
        try {
            if (!isset($_SESSION['ordemdocaos'])) {
                $_SESSION['rpg-list'] = array();

                $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.players` WHERE user_id=?");
                $sql->execute(array($_SESSION['id']));
                if ($sql->rowCount() > 0) {
                    array_push($_SESSION['rpg-list'], 'ordemdocaos');

                    $info = $sql->fetch();

                    foreach ($info as $key => $value) {
                        $_SESSION['ordemdocaos']['geral'][$key] = $value;
                    }

                    $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.atributos` WHERE user_id=?");
                    $sql->execute(array($_SESSION['id']));
                    if ($sql->rowCount() > 0) {
                        $info = $sql->fetch();

                        foreach ($info as $key => $value) {
                            if (!is_int($key) && $key != 'id' && $key != 'user_id') {
                                $_SESSION['ordemdocaos']['atributos'][$key] = $value;
                            }
                        }
                    }

                    $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.pericias` WHERE user_id=?");
                    $sql->execute(array($_SESSION['id']));
                    if ($sql->rowCount() > 0) {
                        $info = $sql->fetch();

                        foreach ($info as $key => $value) {
                            if (!is_int($key) && $key != 'id' && $key != 'user_id' 
                                && !str_ends_with($key, '_bonus')) {
                                $_SESSION['ordemdocaos']['pericias'][$key] = $value;
                            }
                        }
                        foreach ($info as $key => $value) {
                            if (!is_int($key) && $key != 'id' && $key != 'user_id' 
                                && str_ends_with($key, '_bonus')) {
                                $_SESSION['ordemdocaos']['pericias_bonus'][explode('_bonus', $key)[0]] = $value;
                            }
                        }
                    }

                    $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.poderes` WHERE user_id=?");
                    $sql->execute(array($_SESSION['id']));
                    if ($sql->rowCount() > 0) {
                        $info = $sql->fetchAll();

                        foreach ($info as $key => $value) { 
                            $_SESSION['ordemdocaos']['poderes'][$value['id']]['nome'] = $value['nome'];
                            $_SESSION['ordemdocaos']['poderes'][$value['id']]['descricao'] = $value['descricao'];
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            \Utils::alert('Não foi possível carregar a página');
        }
    }

    function getVars() {
        $playerExists = in_array('ordemdocaos', $_SESSION['rpg-list']);
        $vars = [
            'playerExists' => $playerExists
        ];
        if ($playerExists) {
            foreach ($_SESSION['ordemdocaos']['geral'] as $key => $value) {
                $vars[$key] = $value;
            }
            foreach ($_SESSION['ordemdocaos']['atributos'] as $key => $value) {
                $vars['atributos'][$key] = $value;
            }
            foreach ($_SESSION['ordemdocaos']['pericias'] as $key => $value) {
                $vars['pericias'][$key] = $value;
            }
            foreach ($_SESSION['ordemdocaos']['pericias_bonus'] as $key => $value) {
                $vars['pericias_bonus'][$key] = $value;
            }
            if (isset($_SESSION['ordemdocaos']['poderes'])) {
                foreach ($_SESSION['ordemdocaos']['poderes'] as $key => $value) {
                    $vars['poderes'][$key] = $value;
                }
            }
            $vars['getAttrFromSkill'] = $this->getAttrFromSkill();
        }
        return $vars;
    }

    function createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento, 
        $jogador, $exposicao, $origem, $trilha, $pe, $imagem, $vida, $energia, $stamina) 
    {
        try {
            $maxVida = $vida;
            $maxEnergia = $energia;
            $maxStamina = $stamina;

            if (empty($imagem)) return 'Você precisa selecionar uma imagem.';
            if(($imagem['size'] / 1024) > 1024) return 'A imagem deve possuir no máximo 1mb.';

            $imagem['name'] = str_replace(pathinfo
                ($imagem['name'], PATHINFO_FILENAME), $userId.'_'.uniqid(), $imagem['name']);
            $filepath = '../../assets/uploads/' . $imagem['name'];
            if (!move_uploaded_file($imagem['tmp_name'], $filepath)) {
                return 'Não foi possível fazer o upload dessa imagem.';
            }
            $imagem = $imagem['name'];

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
            $numberFields = [
                $idade,
                $pe,
                $vida,
                $maxVida,
                $energia,
                $maxEnergia,
                $stamina,
                $maxStamina
            ];
            foreach ($fields as $value) {
                if (empty($value)) return 'Nenhum campo pode ficar vazio.';
            }
            foreach ($numberFields as $value) {
                if (!is_numeric($value))
                    return 'Você inseriu letras em um campo que aceita apenas números.';
            }
            if (in_array('ordemdocaos', $_SESSION['rpg-list']))
                return 'Você já participa dessa mesa.';

            $sql = \MySQL::connect()->prepare('INSERT INTO `tb_rpg.ordemdocaos.players` 
            VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            if (!$sql->execute($fields))
                throw new \Exception("Ocorreu um erro ao tentar criar a ficha", 1);

            $sql = \MySQL::connect()->prepare("INSERT INTO `tb_rpg.ordemdocaos.atributos` 
            (id, user_id) VALUES (null,?)");
            if (!$sql->execute(array($userId)))
                throw new \Exception("Ocorreu um erro ao tentar criar a ficha", 1);

            $sql = \MySQL::connect()->prepare("INSERT INTO `tb_rpg.ordemdocaos.pericias` 
            (id, user_id) VALUES (null,?)");
            if (!$sql->execute(array($userId)))
                throw new \Exception("Ocorreu um erro ao tentar criar a ficha", 1);
            
            return 'Sucesso';   
        } catch (\Throwable $th) {
            unlink('../../assets/uploads/'.$imagem);
            $this->deletePlayerIfExists($userId);
            return 'Erro: ' . $th->getMessage();
        }
    }

    function deletePlayerIfExists($userId) {
        try {
            $sql = \MySQL::connect()->prepare
                ("
                DELETE FROM `tb_rpg.ordemdocaos.players` WHERE user_id=$userId;
                DELETE FROM `tb_rpg.ordemdocaos.atributos` WHERE user_id=$userId;
                DELETE FROM `tb_rpg.ordemdocaos.pericias` WHERE user_id=$userId;

                ");
            $sql->execute();

        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function getAttrFromSkill() {
        $prefix = $_SESSION['ordemdocaos']['atributos'];
        $arr = [
            'acrobacia' => $prefix['agilidade'],
            'adestramento' => $prefix['presenca'],
            'artes' => $prefix['presenca'],
            'atletismo' => $prefix['forca'],
            'atualidades' => $prefix['inteligencia'],
            'ciencias' => $prefix['inteligencia'],
            'crime' => $prefix['agilidade'],
            'diplomacia' => $prefix['presenca'],
            'enganacao' => $prefix['presenca'],
            'fortitude' => $prefix['vigor'],
            'furtividade' => $prefix['agilidade'],
            'iniciativa' => $prefix['agilidade'],
            'intimidacao' => $prefix['presenca'],
            'intuicao' => $prefix['inteligencia'],
            'investigacao' => $prefix['inteligencia'],
            'luta' => $prefix['forca'],
            'medicina' => $prefix['inteligencia'],
            'percepcao' => $prefix['presenca'],
            'pilotagem' => $prefix['agilidade'],
            'pontaria' => $prefix['agilidade'],
            'profissao' => $prefix['inteligencia'],
            'reflexos' => $prefix['agilidade'],
            'religiao' => $prefix['presenca'],
            'sobrevivencia' => $prefix['inteligencia'],
            'tatica' => $prefix['inteligencia'],
            'tecnologia' => $prefix['inteligencia'],
            'viralismo' => $prefix['inteligencia'],
            'vontade' => $prefix['presenca']
        ];
        return $arr;
    }

    function updateAttributes($attributes) {
        try {
            $queryBegin = "UPDATE `tb_rpg.ordemdocaos.atributos` SET ";
            $queryMiddle = "";
            $queryEnd = " WHERE user_id=".$_SESSION['id'].";";

            $count = 0;
            foreach($attributes as $key => $value) {
                $_SESSION['ordemdocaos']['atributos'][$key] = $value;
                $count++;
                if ($count < sizeof($attributes)) {
                    $queryMiddle .= $key."=".$value.", ";
                } else {
                    $queryMiddle .= $key."=".$value." ";
                }
            }

            $query = $queryBegin . $queryMiddle . $queryEnd;
            $sql = \MySQL::connect()->prepare($query);
            $sql->execute();

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function updateSkills($skills) {
        try {
            $queryBegin = "UPDATE `tb_rpg.ordemdocaos.pericias` SET ";
            $queryMiddle = "";
            $queryEnd = " WHERE user_id=".$_SESSION['id'].";";

            $count = 0;
            foreach($skills as $key => $value) {
                if (str_contains($key, '_bonus')) {
                    $_SESSION['ordemdocaos']['pericias_bonus'][explode('_bonus', $key)[0]] = $value;
                } else {
                    $_SESSION['ordemdocaos']['pericias'][$key] = $value;
                }
                $count++;
                if ($count < sizeof($skills)) {
                    $queryMiddle .= $key."=".$value.", ";
                } else {
                    $queryMiddle .= $key."=".$value." ";
                }
            }

            $query = $queryBegin . $queryMiddle . $queryEnd;
            $sql = \MySQL::connect()->prepare($query);
            $sql->execute();

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function addPower($name, $description) {
        try {
            $userId = $_SESSION['id'];
            $sql = \MySQL::connect();
            $query = $sql->prepare("INSERT INTO `tb_rpg.ordemdocaos.poderes` 
                 VALUES (null,?,?,?)");
            $query->execute(array($userId, $name, $description));
            $lastId = $sql->lastInsertId();

            $_SESSION['ordemdocaos']['poderes'][$lastId]['nome'] = $name;
            $_SESSION['ordemdocaos']['poderes'][$lastId]['descricao'] = $description;

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }
}
?>