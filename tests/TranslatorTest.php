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
    public function testTranslateFromDynamicDomain_Success()
    {
        $this->assertEquals('Overridé par dynamic', $this->getTranslator()->translate('dynamic_test'));
    }

    /**
     * @test
     */
    public function testTranslateFromGlobalDomain_Success()
    {
        $this->assertEquals('Test global', $this->getTranslator()->translate('global_text'));
    }

    /**
     * @test
     */
    public function testTranslateWithVariable_Success()
    {
        $translated = $this->getTranslator()->translate('test_with_variable', ['variableName' => 'Leeroy']);
        $this->assertEquals('Test contenant Leeroy comme variable', $translated);
    }

    /**
     * @test
     */
    public function testTranslateInEnglish_Success()
    {
        $translated = $this->getTranslator('en')->translate('test_without_fallback');
        $this->assertEquals('Text translated in english', $translated);
    }

    /**
     * @test
     */
    public function testTranslateFallbackToFrench_Success()
    {
        $translated = $this->getTranslator('en')->translate("test_with_fallback");
        $this->assertEquals('Test avec fallback en français', $translated);
    }

    /**
     * @test
     */
    public function testSetLocaleChangesLocale_Success()
    {
        $translated = $this->getTranslator()->translate('test_without_fallback');
        $this->assertEquals('Test traduit en anglais', $translated);

        $translated = $this->getTranslator()->setLocale('en')->translate('test_without_fallback');
        $this->assertEquals('Text translated in english', $translated);
    }

    /**
     * @param string $locale
     * @return TipeeTranslator
     */
    private function getTranslator($locale = 'fr')
    {
        return new Translator($locale, __DIR__.'/locale/', 'global');
    }
}