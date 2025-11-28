<?php
namespace template;

interface ITemplate {
    public function layout($caminho, $dados = null);
}