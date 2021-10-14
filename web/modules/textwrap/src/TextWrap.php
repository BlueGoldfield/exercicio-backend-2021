<?php

namespace Drupal\textwrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - [✔] Crie um PR no github com seu código
 * - [✔] Veja o resultado da correção automática do seu código
 * - [✔] Commit até os testes passarem
 * - [ ] Passou tudo, melhore a cobertura dos testes
 * - [ ] Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    // Apague o código abaixo e escreva sua própria implementação,
    // nós colocamos esse mock para poder rodar a análise de cobertura dos
    // testes unitários.
    $ret = []; //inicializar o array final
    $strings = explode(' ', $text); //separar a string em um array de strings menores
    $line = 0; //inicializar a variável contadora de linhas
    for ($str = 0; $str < count($strings); $str++) { //iterar sobre o array de strings
      if (mb_strlen($strings[$str], "utf-8") < $length) { //verificar se a string atual é menor do que o tamanho máximo especificado
        if (!empty($ret[$line])) { //verificar se o index do array final esta vazio
          $ret[$line] = $ret[$line] . $strings[$str]; //se não estiver, copiar o valor atual e concatenar a string
        } else { //senão
          $ret[$line] = $strings[$str]; //definir o valor dele como a string
        }
        if (empty($strings[$str+1]) or mb_strlen($ret[$line] . $strings[$str+1], "utf-8") >= $length) { //verificar se o proximo index no array de strings esta vazio 
          //ou se o tamanho da string atual somado com a proxima string é maior ou igual o tamanho máximo especificado
          ++$line; //se sim, pular para a próxima linha
        } else { //senão
          $ret[$line] = $ret[$line] . ' '; //concatenar o valor atual e um espaço em branco
        }
      } elseif (mb_strlen($strings[$str], "utf-8") === $length) { //senão, verificar se o tamanho da string atual for o mesmo do máximo especificado
        $ret[$line] = $strings[$str]; //se sim, definir o valor do index do array final como a string atual
        ++$line; //pular para a próxima linha
      } else { //senão, ou seja, o tamanho da string excedeu o tamanho máximo especificado
        $bwl = mb_strlen($strings[$str], "utf-8"); //inicializa a variável bwl (Big Word Length) com o valor do comprimento da string
        while ($bwl > $length) { //enquanto o valor de bwl for maior que o tamanho máximo delimitado
          $ret[$line] = substr($strings[$str], 0, $length); //cortar a string do ponto inicial até o caractere na posição do tamanho máximo
          ++$line; //pular para a próxima linha
          $ret[$line] = substr($strings[$str], $length); //pegar o resto da string
          $bwl = mb_strlen($ret[$line], "utf-8"); //atualizar o valor de bwl com o tamanho da nova string
          ++$line; //pular para a próxima linha
        }
      }
    }
    return $ret; //retornar o array final
  }

}
