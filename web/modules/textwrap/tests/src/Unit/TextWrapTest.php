<?php

namespace Drupal\textwrap\Tests;

use Drupal\textwrap\TextWrap;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Drupal\textwrap\TextWrap.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp(): void  {
    $this->resolucao = new TextWrap();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->anotherString = "Conhece-te a ti mesmo, torna-te consciente de tua ignorância e serás sábio";
    $this->yetAnotherString = "Conhecimento é poder";
    $this->finalString = "Conhecer a si mesmo é o começo de toda sabedoria";
  }

  /**
   * Checa o retorno para strings vazias.
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->wrap("", 2021);
    $this->assertEmpty($ret[0]);
    $this->assertCount(1, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->wrap($this->baseString, 8);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé sobre", $ret[5]);
    $this->assertEquals("ombros", $ret[6]);
    $this->assertEquals("de", $ret[7]);
    $this->assertEquals("gigantes", $ret[8]);
    $this->assertCount(9, $ret);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->wrap($this->baseString, 12);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
    $this->assertCount(6, $ret);
  }

  /**
   * Testa a quebra de linha para palavras longas.
   */
  public function testForBigWords() {
    $ret = $this->resolucao->wrap($this->anotherString, 8);
    $this->assertEquals("Conhece-", $ret[0]);
    $this->assertEquals("te a ti", $ret[1]);
    $this->assertEquals("mesmo,", $ret[2]);
    $this->assertEquals("torna-te", $ret[3]);
    $this->assertEquals("conscien", $ret[4]);
    $this->assertEquals("te de", $ret[5]);
    $this->assertEquals("tua", $ret[6]);
    $this->assertEquals("ignorân", $ret[7]);
    $this->assertEquals("cia e", $ret[8]);
    $this->assertEquals("serás", $ret[9]);
    $this->assertEquals("sábio", $ret[10]);
    $this->assertCount(11, $ret);
  }

  /**
   * Testa a quebra de linha para palavras longas.
   */
  public function testForBigWords2() {
    $ret = $this->resolucao->wrap($this->yetAnotherString, 8);
    $this->assertEquals("Conhecim", $ret[0]);
    $this->assertEquals("ento é", $ret[1]);
    $this->assertEquals("poder", $ret[2]);
    $this->assertCount(3, $ret);
  }

  /**
   * Testa a quebra de linha para palavras longas no final da string.
   */
  public function testForFinalBigWord() {
    $ret = $this->resolucao->wrap($this->finalString, 8);
    $this->assertEquals("Conhecer", $ret[0]);
    $this->assertEquals("a si", $ret[1]);
    $this->assertEquals("mesmo é", $ret[2]);
    $this->assertEquals("o começo", $ret[3]);
    $this->assertEquals("de toda", $ret[4]);
    $this->assertEquals("sabedori", $ret[5]);
    $this->assertEquals("a", $ret[6]);
    $this->assertCount(7, $ret);
  }
}