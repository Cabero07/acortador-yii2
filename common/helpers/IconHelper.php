<?php

namespace common\helpers;

class IconHelper
{
    /**
     * Obtiene el ícono (favicon) de una URL.
     *
     * @param string $url La URL del sitio web.
     * @return string|null La URL del favicon o null si no se encuentra.
     */
    public static function getFavicon($url)
    {
        try {
            // Agregar "http://" si no se proporciona un esquema
            if (!preg_match('/^https?:\/\//', $url)) {
                $url = 'https://' . $url;
            }

            $parsedUrl = parse_url($url);
            if (!isset($parsedUrl['scheme']) || !isset($parsedUrl['host'])) {
                return null;
            }

            $faviconUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . '/favicon.ico';
            // Verificar si el favicon existe
            $headers = @get_headers($faviconUrl);
            if ($headers && strpos($headers[0], '200') !== false) {
                return $faviconUrl;
            }
            return null;
        } catch (\Exception $e) {
            \Yii::error('Error obteniendo el favicon: ' . $e->getMessage());
            return null;
        }
    }
}