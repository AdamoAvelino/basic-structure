<?php

namespace App\src\QueryBuild;

trait BindsTrait 
{
    /**
     * ---------------------------------------------------------------------------------
     */
    protected function gerarBinds(Array $dados) : string
    {
        $binds = array_reduce($dados, function($previues, $current) {
            array_push($previues, '?');
            return $previues; 
        }, []);

        return implode(',', $binds);
    }

    /**
     * --------------------------------------------------------------------------------------
     */
    private function parametrosWhereBind(Array $parametros) : Array
    {
        $prepararDados = [
            'condicoes' => [],
            'valores' => [],
        ];
        
        array_map(function($atributo) use (&$prepararDados) {

            $coringa = '';
            if($atributo[2] !== '' and $atributo[2] !== null) {
                
                if(is_array($atributo[2])) {
                    $coringa = $atributo[1] == 'BETWEEN' ? ' ? AND ? ' : '(' . $this->gerarBinds($atributo[2]) .')'; 
                    $prepararDados['valores'] = array_merge($prepararDados['valores'], $atributo[2]);
                } else {
                    $coringa = '?';    
                    $prepararDados['valores'][] =  isset($atributo[3]) ? $this->bindLike($atributo[2], $atributo[3]) : $atributo[2];
                } 
            }

            $prepararDados['condicoes'][] = $atributo[0]. " " . $atributo[1] ." ". $coringa;

        }, $parametros);

        $prepararDados['valores'] = $this->apenasAtributosPreenchidos($prepararDados['valores']);
        return $prepararDados;
    }

    protected function bindLike(String $valor, String $parte) : String
    {
        if($parte == 'inicio') {
            $valor = "{$valor}%";
        } else if($parte == 'final') {
            $valor = "%{$valor}";
        } else {
            $valor = "%{$valor}%";
        }

        return $valor;
    }

     /**
     * ------------------------------------------------------------------------------------
     */
    protected function update(Array $dados) : string
    {
        $prepararDados = [];
        $dadosbind = array_map(function($atributo) use (&$prepararDados) {
            
            $prepararDados[] = $atributo." = ?";

        }, array_keys($dados));

        return implode(',', $prepararDados);
    }

    /**
     * ------------------------------------------------------------------------------------
     */
    protected function whereAnd(Array $condicaoesAnd) : Array
    {
        $dadosbind = $this->parametrosWhereBind($condicaoesAnd);
        $where['condicao'] = '('.implode(' AND ', $dadosbind['condicoes']).")";
        $where['valores'] = $dadosbind['valores'];
        return $where;
    }

    /**
     * ------------------------------------------------------------------------------------
     */
    protected function whereOr(Array $condicaoesOr) : Array
    {
        $dadosbind = $this->parametrosWhereBind($condicaoesOr);
        $where['condicao'] = '('.implode(' OR ', $dadosbind['condicoes']).")";
        $where['valores'] = $dadosbind['valores'];
        return $where;
    }

    /**
     * ---------------------------------------------------------------------------------------
     *
 
     */
    protected function apenasAtributosPreenchidos(Array $dados) : Array
    {
        $retorno = array_filter($dados, function($dado) {
            $valor = sprintf('%s', $dado);
            return ($valor !== ''); 
        });

        return $retorno;
    }
}