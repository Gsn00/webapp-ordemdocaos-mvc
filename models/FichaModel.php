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

                    $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.ataques` WHERE user_id=?");
                    $sql->execute(array($_SESSION['id']));
                    if ($sql->rowCount() > 0) {
                        $info = $sql->fetchAll();

                        foreach ($info as $key => $value) { 
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['arma'] = $value['arma'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['tipo'] = $value['tipo'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['ataque'] = $value['ataque'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['alcance'] = $value['alcance'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['dano'] = $value['dano'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['critico'] = $value['critico'];
                            $_SESSION['ordemdocaos']['ataques'][$value['id']]['especial'] = $value['especial'];
                        }
                    }

                    $sql = \MySQL::connect()->prepare
                    ("SELECT * FROM `tb_rpg.ordemdocaos.inventario` WHERE user_id=?");
                    $sql->execute(array($_SESSION['id']));
                    if ($sql->rowCount() > 0) {
                        $info = $sql->fetchAll();

                        foreach ($info as $key => $value) { 
                            $_SESSION['ordemdocaos']['inventario'][$value['id']]['nome'] = $value['nome'];
                            $_SESSION['ordemdocaos']['inventario'][$value['id']]['quantidade'] = $value['quantidade'];
                            $_SESSION['ordemdocaos']['inventario'][$value['id']]['categoria'] = $value['categoria'];
                            $_SESSION['ordemdocaos']['inventario'][$value['id']]['tipo'] = $value['tipo'];
                        }
                    }
                }
            }
            $this->checkBarValues();
        } catch (\Throwable $th) {
            \Utils::alert('Não foi possível carregar a página');
        }
    }

    function checkBarValues() {
        if (isset($_SESSION['ordemdocaos'])) {
            $queryBegin = "UPDATE `tb_rpg.ordemdocaos.players` SET ";
            $queryMiddle = "";
            $queryEnd = " WHERE user_id=".$_SESSION['id'].";";

            $prefix = $_SESSION['ordemdocaos']['geral'];
            $bars = [
                'vida' => $prefix['vida'],
                'sanidade' => $prefix['sanidade'],
                'esforco' => $prefix['esforco']
            ];
            $count = 0;
            foreach ($bars as $key => $value) {
                if (intval($value) > intval($prefix['max_'.$key])) {
                    if ($count > 0) {
                        $queryMiddle .= ", ".$key."=".$prefix['max_'.$key]." ";
                    } else {
                        $queryMiddle .= $key."=".$prefix['max_'.$key]." ";
                    }
                    $_SESSION['ordemdocaos']['geral'][$key] = $prefix['max_'.$key];
                    $count++;
                }
                if (intval($value) < 0) {
                    if ($count > 0) {
                        $queryMiddle .= ", ".$key."=0 ";
                    } else {
                        $queryMiddle .= $key."=0";
                    }
                    $_SESSION['ordemdocaos']['geral'][$key] = 0;
                    $count++;
                }
                if ($count > 0) {
                    $query = $queryBegin . $queryMiddle . $queryEnd;
                    $sql = \MySQL::connect()->prepare($query);
                    $sql->execute();
                }
            }
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
            $vars['defesa'] = $this->getDefense();
            $vars['bloqueio'] = $this->getBlock();
            $vars['esquiva'] = $this->getDodge();

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
            if (isset($_SESSION['ordemdocaos']['ataques'])) {
                foreach ($_SESSION['ordemdocaos']['ataques'] as $key => $value) {
                    $vars['ataques'][$key] = $value;
                }
            }
            if (isset($_SESSION['ordemdocaos']['inventario'])) {
                foreach ($_SESSION['ordemdocaos']['inventario'] as $key => $value) {
                    $vars['inventario'][$key] = $value;
                }
            }
            $vars['getAttrFromSkill'] = $this->getAttrFromSkill();
        }
        return $vars;
    }

    function getPeRound($exposicao) {
        if ($exposicao == 0) return 1;
        if ($exposicao == 99) return 21;
        $pe = $exposicao / 5 + 1;
        return $pe;
    }

    function getMaxHealth($classe, $exposicao, $vigor) {
        $exposicao = ceil(intval($exposicao) / 5);
        $vigor = (intval($vigor) < 0) ? 0 : intval($vigor);
        if ($classe == 'combatente') {
            $vida = 20 + $vigor + ((4 + $vigor) * $exposicao);
            return $vida;
        }
        if ($classe == 'investigador') {
            $vida = 16 + $vigor + ((3 + $vigor) * $exposicao);
            return $vida;
        }
    }

    function getMaxSanity($classe, $exposicao) {
        $exposicao = ceil($exposicao / 5);
        if ($classe == 'combatente') {
            $sanity = 12 + (3 * $exposicao);
            return $sanity;
        }
        if ($classe == 'investigador') {
            $sanity = 16 + (4 * $exposicao);
            return $sanity;
        }
    }

    function getMaxEffort($classe, $exposicao, $presenca) {
        $exposicao = ceil(intval($exposicao) / 5);
        $presenca = (intval($presenca) < 0) ? 0 : intval($presenca);
        if ($classe == 'combatente') {
            $effort = 2 + $presenca + ((2 + $presenca) * $exposicao);
            return $effort;
        }
        if ($classe == 'investigador') {
            $effort = 3 + $presenca + ((3 + $presenca) * $exposicao);
            return $effort;
        }
    }

    function getDefense() {
        $agilidade = $_SESSION['ordemdocaos']['atributos']['agilidade'];
        $agilidade = intval($agilidade);
        return 10 + $agilidade + $this->getDodge();
    }

    function getBlock() {
        $fortitude = $_SESSION['ordemdocaos']['pericias']['fortitude'];
        $fortitude += $_SESSION['ordemdocaos']['pericias_bonus']['fortitude'];
        $fortitude = intval($fortitude);
        return $fortitude;
    }

    function getDodge() {
        $reflexos = $_SESSION['ordemdocaos']['pericias']['reflexos'];
        $reflexos += $_SESSION['ordemdocaos']['pericias_bonus']['reflexos'];
        $reflexos = intval($reflexos);
        return $reflexos;
    }

    function createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento, 
        $jogador, $exposicao, $origem, $trilha, $imagem) 
    {
        try {
            if (empty($imagem)) return 'Você precisa selecionar uma imagem.';
            if(($imagem['size'] / 1024) > 1024) return 'A imagem deve possuir no máximo 1mb.';

            $imagem['name'] = str_replace(pathinfo
                ($imagem['name'], PATHINFO_FILENAME), $userId.'_'.uniqid(), $imagem['name']);
            $filepath = '../../assets/uploads/' . $imagem['name'];
            if (!move_uploaded_file($imagem['tmp_name'], $filepath)) {
                return 'Não foi possível fazer o upload dessa imagem.';
            }
            $imagem = $imagem['name'];

            $peRodada = $this->getPeRound($exposicao);
            $vida = $this->getMaxHealth($classe, $exposicao, 1);
            $maxVida = $vida;
            $esforco = $this->getMaxEffort($classe, $exposicao, 1);
            $maxEsforco = $esforco;
            $sanidade = $this->getMaxSanity($classe, $exposicao);
            $maxSanidade = $sanidade;

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
                $peRodada,
                $imagem,
                $vida,
                $maxVida,
                $sanidade,
                $maxSanidade,
                $esforco,
                $maxEsforco
            ];

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

    function updateFicha($userId, $nome, $classe, $idade, $nacionalidade, 
        $deslocamento, $exposicao, $origem, $trilha, $imagem) 
    {
        try {

            $newImage = false;
            if (empty($imagem)) {
                $imagem = $_SESSION['ordemdocaos']['geral']['imagem'];
            } else {
                if(($imagem['size'] / 1024) > 1024) return 'A imagem deve possuir no máximo 1mb.';

                $imagem['name'] = str_replace(pathinfo
                ($imagem['name'], PATHINFO_FILENAME), $userId.'_'.uniqid(), $imagem['name']);
                $filepath = '../../assets/uploads/' . $imagem['name'];
                if (!move_uploaded_file($imagem['tmp_name'], $filepath)) {
                    return 'Não foi possível fazer o upload dessa imagem.';
                }
                $imagem = $imagem['name'];
                $newImage = true;
            }

            $vigor = intval($_SESSION['ordemdocaos']['atributos']['vigor']);
            $presenca = intval($_SESSION['ordemdocaos']['atributos']['presenca']);
            $peRodada = $this->getPeRound($exposicao);

            $maxVida = $this->getMaxHealth($classe, $exposicao, $vigor);
            $maxSanidade = $this->getMaxSanity($classe, $exposicao);
            $maxEsforco = $this->getMaxEffort($classe, $exposicao, $presenca);

            $fields = [
                $nome,
                $classe,
                $idade,
                $nacionalidade,
                $deslocamento,
                $exposicao,
                $origem,
                $trilha,
                $peRodada,
                $imagem,
                $maxVida,
                $maxSanidade,
                $maxEsforco,
                $userId
            ];

            $sql = \MySQL::connect()->prepare('UPDATE `tb_rpg.ordemdocaos.players` 
            SET nome=?, classe=?, idade=?, nacionalidade=?, deslocamento=?, exposicao=?, origem=?,
            trilha=?, pe_rodada=?, imagem=?, max_vida=?, max_sanidade=?, max_esforco=? WHERE user_id=?');
            if (!$sql->execute($fields))
                throw new \Exception("Ocorreu um erro ao tentar criar a ficha", 1);

            $_SESSION['ordemdocaos']['geral']['max_vida'] = $maxVida;
            $_SESSION['ordemdocaos']['geral']['max_sanidade'] = $maxSanidade;
            $_SESSION['ordemdocaos']['geral']['max_esforco'] = $maxEsforco;

            $sql = \MySQL::connect()->prepare
            ("SELECT * FROM `tb_rpg.ordemdocaos.players` WHERE user_id=?");
            $sql->execute(array($userId));

            if ($sql->rowCount() > 0) {
                $info = $sql->fetch();

                if ($newImage) {
                    $oldImage = $_SESSION['ordemdocaos']['geral']['imagem'];
                    unlink('../../assets/uploads/'.$oldImage);
                }

                foreach ($info as $key => $value) {
                    $_SESSION['ordemdocaos']['geral'][$key] = $value;
                }
            }

            return 'Sucesso';   
        } catch (\Throwable $th) {
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
                DELETE FROM `tb_rpg.ordemdocaos.poderes` WHERE user_id=$userId;
                DELETE FROM `tb_rpg.ordemdocaos.ataques` WHERE user_id=$userId;
                DELETE FROM `tb_rpg.ordemdocaos.inventario` WHERE user_id=$userId;
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
            
            $newQueryBegin = "UPDATE `tb_rpg.ordemdocaos.players` SET ";
            $newQueryMiddle = "";
            $newQueryEnd = " WHERE user_id=".$_SESSION['id'].";";

            $classe = $_SESSION['ordemdocaos']['geral']['classe'];
            $exposicao = ceil($_SESSION['ordemdocaos']['geral']['exposicao']);

            $count = 0;
            $countAttr = 0;
            foreach($attributes as $key => $value) {
                if ($key == 'vigor') {
                    $maxVida = $this->getMaxHealth($classe, $exposicao, intval($value));
                    $_SESSION['ordemdocaos']['geral']['max_vida'] = $maxVida;
                    if ($countAttr == 0) {
                        $newQueryMiddle .= "max_vida=".$maxVida." ";
                    } else {
                        $newQueryMiddle .= ", max_vida=".$maxVida." ";
                    }
                    $countAttr++;
                }
                if ($key == 'presenca') {
                    $maxEsforco = $this->getMaxEffort($classe, $exposicao, intval($value));
                    $_SESSION['ordemdocaos']['geral']['max_esforco'] = $maxEsforco;
                    if ($countAttr == 0) {
                        $newQueryMiddle .= "max_esforco=".$maxEsforco." ";
                    } else {
                        $newQueryMiddle .= ", max_esforco=".$maxEsforco." ";
                    }
                    $countAttr++;
                }

                $_SESSION['ordemdocaos']['atributos'][$key] = $value;
                $count++;
                if ($count < sizeof($attributes)) {
                    $queryMiddle .= $key."=".$value.", ";
                } else {
                    $queryMiddle .= $key."=".$value." ";
                }
            }

            if ($count > 0) {
                if ($countAttr > 0) {
                    $query = $queryBegin . $queryMiddle . $queryEnd . 
                    $newQueryBegin. $newQueryMiddle . $newQueryEnd;
                } else {
                    $query = $queryBegin . $queryMiddle . $queryEnd;
                }
                $sql = \MySQL::connect()->prepare($query);
                $sql->execute();
            }

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

            if ($count > 0) {
                $query = $queryBegin . $queryMiddle . $queryEnd;
                $sql = \MySQL::connect()->prepare($query);
                $sql->execute();
            }

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function addPower($name, $description) {
        try {
            if ($name == '') {
                return 'O nome não pode ficar vazio.';
            }

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

    function deletePower($powerId) {
        try {
            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("DELETE FROM `tb_rpg.ordemdocaos.poderes` 
            WHERE id=? AND user_id=?");
            $sql->execute(array($powerId, $userId));

            unset($_SESSION['ordemdocaos']['poderes'][$powerId]);

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function updatePower($powerId, $name, $description) {
        try {
            if ($name == '') {
                return 'O nome não pode ficar vazio.';
            }

            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("UPDATE `tb_rpg.ordemdocaos.poderes` 
            SET nome=?, descricao=? WHERE id=? AND user_id=?");
            $sql->execute(array($name, $description, $powerId, $userId));

            $_SESSION['ordemdocaos']['poderes'][$powerId]['nome'] = $name;
            $_SESSION['ordemdocaos']['poderes'][$powerId]['descricao'] = $description;

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function addAttack($arr) {
        try {
            foreach ($arr as $value) {
                if ($value == '') {
                    return 'Nenhum campo pode ficar vazio.';
                }
            }

            $userId = $_SESSION['id'];
            $sql = \MySQL::connect();
            $query = $sql->prepare("INSERT INTO `tb_rpg.ordemdocaos.ataques` 
            VALUES (null,?,?,?,?,?,?,?,?)");
            $query->execute($arr);
            $lastId = $sql->lastInsertId();

            $_SESSION['ordemdocaos']['ataques'][$lastId]['arma'] = $arr[1];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['tipo'] = $arr[2];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['ataque'] = $arr[3];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['alcance'] = $arr[4];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['dano'] = $arr[5];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['critico'] = $arr[6];
            $_SESSION['ordemdocaos']['ataques'][$lastId]['especial'] = $arr[7];

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function deleteAttack($ataqueId) {
        try {
            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("DELETE FROM `tb_rpg.ordemdocaos.ataques` 
            WHERE id=? AND user_id=?");
            $sql->execute(array($ataqueId, $userId));

            unset($_SESSION['ordemdocaos']['ataques'][$ataqueId]);

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function updateAttack($arr) {
        try {
            foreach ($arr as $value) {
                if ($value == '') {
                    return 'Nenhum campo pode ficar vazio';
                }
            }

            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("UPDATE `tb_rpg.ordemdocaos.ataques` 
            SET arma=?, tipo=?, ataque=?, alcance=?, dano=?, critico=?, especial=?
            WHERE id=? AND user_id=?");
            $sql->execute($arr);

            $ataqueId = $arr[7];

            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['arma'] = $arr[0];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['tipo'] = $arr[1];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['ataque'] = $arr[2];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['alcance'] = $arr[3];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['dano'] = $arr[4];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['critico'] = $arr[5];
            $_SESSION['ordemdocaos']['ataques'][$ataqueId]['especial'] = $arr[6];

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function addInventory($arr) {
        try {
            foreach ($arr as $value) {
                if ($value == '') {
                    return 'Nenhum campo pode ficar vazio.';
                }
            }

            $userId = $_SESSION['id'];
            $sql = \MySQL::connect();
            $query = $sql->prepare("INSERT INTO `tb_rpg.ordemdocaos.inventario` 
            VALUES (null,?,?,?,?,?)");
            $query->execute($arr);
            $lastId = $sql->lastInsertId();

            $_SESSION['ordemdocaos']['inventario'][$lastId]['nome'] = $arr[1];
            $_SESSION['ordemdocaos']['inventario'][$lastId]['quantidade'] = $arr[2];
            $_SESSION['ordemdocaos']['inventario'][$lastId]['categoria'] = $arr[3];
            $_SESSION['ordemdocaos']['inventario'][$lastId]['tipo'] = $arr[4];

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function deleteInventory($inventarioId) {
        try {
            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("DELETE FROM `tb_rpg.ordemdocaos.inventario` 
            WHERE id=? AND user_id=?");
            $sql->execute(array($inventarioId, $userId));

            unset($_SESSION['ordemdocaos']['inventario'][$inventarioId]);

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function updateInventory($arr) {
        try {
            foreach ($arr as $value) {
                if ($value == '') {
                    return 'Nenhum campo pode ficar vazio';
                }
            }

            $userId = $_SESSION['id'];
            $sql = \MySQL::connect()->prepare("UPDATE `tb_rpg.ordemdocaos.inventario` 
            SET nome=?, quantidade=?, categoria=?, tipo=? WHERE id=? AND user_id=?");
            $sql->execute($arr);

            $inventarioId = $arr[4];

            $_SESSION['ordemdocaos']['inventario'][$inventarioId]['nome'] = $arr[0];
            $_SESSION['ordemdocaos']['inventario'][$inventarioId]['quantidade'] = $arr[1];
            $_SESSION['ordemdocaos']['inventario'][$inventarioId]['categoria'] = $arr[2];
            $_SESSION['ordemdocaos']['inventario'][$inventarioId]['tipo'] = $arr[3];

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }

    function updateBar($bar, $current) {
        try {
            $max = $_SESSION['ordemdocaos']['geral']['max_'.$bar];
            if ($current > $max) $current = $max;
            if ($current < 0) $current = 0;
            $_SESSION['ordemdocaos']['geral'][$bar] = $current;

            $sql = \MySQL::connect()->prepare("UPDATE `tb_rpg.ordemdocaos.players` 
            SET ".$bar."=? WHERE user_id=?");
            $sql->execute(array($current, $_SESSION['id']));

            return 'Sucesso';
        } catch (\Throwable $th) {
            return 'Erro: ' . $th->getMessage();
        }
    }
}
?>