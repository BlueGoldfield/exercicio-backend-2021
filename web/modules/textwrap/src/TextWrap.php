<?php

namespace Drupal\textwrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - [✔] Crie um PR no github com seu código
 * - [ ] Veja o resultado da correção automática do seu código
 * - [ ] Commit até os testes passarem
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
      if (strlen($strings[$str]) < $length) { //verificar se a string atual é menor do que o tamanho máximo especificado
        if (!empty($ret[$line])) { //verificar se o index do array final esta vazio
          $ret[$line] = $ret[$line] . $strings[$str]; //se não estiver, copiar o valor atual e concatenar a string
        } else { //senão
          $ret[$line] = $strings[$str]; //definir o valor dele como a string
        }
        if (empty($strings[$str+1]) or strlen($ret[$line] . $strings[$str+1]) >= $length) { //verificar se o proximo index no array de strings esta vazio 
          //ou se o tamanho da string atual somado com a proxima string é maior ou igual o tamanho máximo especificado
          ++$line; //se sim, pular para a próxima linha
        } else { //senão
          $ret[$line] = $ret[$line] . ' '; //concatenar o valor atual e um espaço em branco
        }
      } elseif (strlen($strings[$str]) === $length) { //senão, verificar se o tamanho da string atual for o mesmo do máximo especificado
        ++$line; //se sim, pular para a próxima linha
        $ret[$line] = $strings[$str]; //definir o valor do index do array final como a string atual
      } else { //senão
        ++$line; //pular para a próxima linha
        $ret[$line] = 'over'; //implementar depois
      }
    }
    return $ret; //retornar o array final
  }

}
