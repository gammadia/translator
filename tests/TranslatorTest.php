<?php

namespace Gammadia\i18n\Tests;

use PHPUnit\Framework\TestCase;
use Gammadia\i18n\Translator;

/**
 * Class TipeeTranslatorTest
 * @package unit\brain\utils
 */
class TranslatorTest extends TestCase
{
    /**
     * @test
     */
    public function testTranslateFromDynamicDomain_Success(): void
    {
        $this->assertEquals('Overridé par dynamic', $this->getTranslator()->translate('dynamic_test'));
    }

    /**
     * @test
     */
    public function testTranslateFromGlobalDomain_Success(): void
    {
        $this->assertEquals('Test global', $this->getTranslator()->translate('global_text'));
    }

    /**
     * @test
     */
    public function testTranslateWithVariable_Success(): void
    {
        $translated = $this->getTranslator()->translate('test_with_variable', ['variableName' => 'Leeroy']);
        $this->assertEquals('Test contenant Leeroy comme variable', $translated);
    }

    /**
     * @test
     */
    public function testTranslateInEnglish_Success(): void
    {
        $translated = $this->getTranslator('en')->translate('test_without_fallback');
        $this->assertEquals('Text translated in english', $translated);
    }

    /**
     * @test
     */
    public function testTranslateFallbackToFrench_Success(): void
    {
        $translated = $this->getTranslator('en')->translate("test_with_fallback");
        $this->assertEquals('Test avec fallback en français', $translated);
    }

    /**
     * @test
     */
    public function testSetLocaleChangesLocale_Success(): void
    {
        $translated = $this->getTranslator()->translate('test_without_fallback');
        $this->assertEquals('Test traduit en anglais', $translated);

        $translated = $this->getTranslator()->setLocale('en')->translate('test_without_fallback');
        $this->assertEquals('Text translated in english', $translated);
    }

    /**
     * @test
     */
    public function testCapitalize(): void
    {
        $capitalized = $this->getTranslator()->translate('text_lowercase');
        $this->assertEquals('Test en minuscules', $capitalized);

        $notCapitalized = $this->getTranslator()->translate('text_lowercase', [], false);
        $this->assertEquals('test en minuscules', $notCapitalized);
    }

    private function getTranslator(string $locale = 'fr'): Translator
    {
        return new Translator($locale, __DIR__.'/locale/', 'global');
    }
}