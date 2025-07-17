<?php

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Usuario extends Model
{
    protected ?string $table = 'usuario'; // Nome da tabela

    protected array $fillable = ['nome', 'cpf_cnpj','data_nascimento','renda_faturamento','telefone', 'email']; // Campos permitidos para inserção
}