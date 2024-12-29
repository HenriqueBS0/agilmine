<?php

namespace App\Services;

/**
 * Classe para manipulação de cores e criação de tints e shades.
 */
class ColorMixer
{

    public function corTexto($cor)
    {
        return $this->shadeColor($cor, 60);
    }

    public function corFundo($cor)
    {
        return $this->tintColor($cor, 80);
    }

    public function corBorda($cor)
    {
        return $this->tintColor($cor, 60);
    }

    /**
     * Gera um tom mais claro (tint) de uma cor.
     *
     * @param string $color Cor em formato hexadecimal (ex: "#RRGGBB").
     * @param float $weight Peso para mistura (0 a 100).
     * @return string Cor resultante em hexadecimal.
     */
    public function tintColor(string $color, float $weight): string
    {
        $weight = $this->normalizeWeight($weight);
        [$r, $g, $b] = $this->extractRGB($color);

        return $this->mixColor($r, $g, $b, 255, $weight);
    }

    /**
     * Gera um tom mais escuro (shade) de uma cor.
     *
     * @param string $color Cor em formato hexadecimal (ex: "#RRGGBB").
     * @param float $weight Peso para mistura (0 a 100).
     * @return string Cor resultante em hexadecimal.
     */
    public function shadeColor(string $color, float $weight): string
    {
        $weight = $this->normalizeWeight($weight);
        [$r, $g, $b] = $this->extractRGB($color);

        return $this->mixColor($r, $g, $b, 0, $weight);
    }

    /**
     * Normaliza o peso para uma escala entre 0 e 1.
     *
     * @param float $weight Peso para mistura (0 a 100).
     * @return float Peso normalizado (0.0 a 1.0).
     */
    private function normalizeWeight(float $weight): float
    {
        return max(0, min(100, $weight)) / 100;
    }

    /**
     * Extrai os componentes RGB de uma cor hexadecimal.
     *
     * @param string $color Cor em formato hexadecimal (ex: "#RRGGBB").
     * @return array Array contendo os valores de R, G e B.
     */
    private function extractRGB(string $color): array
    {
        return sscanf($color, "#%02x%02x%02x");
    }

    /**
     * Mistura uma cor base com um alvo (branco ou preto).
     *
     * @param int $r Vermelho (0-255).
     * @param int $g Verde (0-255).
     * @param int $b Azul (0-255).
     * @param int $target Cor alvo (0 para preto, 255 para branco).
     * @param float $weight Peso da mistura (0.0 a 1.0).
     * @return string Cor resultante em hexadecimal.
     */
    private function mixColor(int $r, int $g, int $b, int $target, float $weight): string
    {
        $mix = fn($base) => (int) round($base + ($target - $base) * $weight);

        $r = $mix($r);
        $g = $mix($g);
        $b = $mix($b);

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }
}
