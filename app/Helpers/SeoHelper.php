<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate clean meta description from HTML content
     * 
     * @param string $html
     * @param int $length
     * @return string
     */
    public static function generateMetaDescription($html, $length = 160)
    {
        // Strip HTML tags
        $text = strip_tags($html);

        // Remove extra whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        // Trim and truncate
        $text = trim($text);

        if (strlen($text) > $length) {
            $text = substr($text, 0, $length);
            // Cut at last complete word
            $text = substr($text, 0, strrpos($text, ' ')) . '...';
        }

        return self::sanitize($text);
    }

    /**
     * Sanitize text for meta tags
     * 
     * @param string $text
     * @return string
     */
    public static function sanitize($text)
    {
        // Remove special characters that might break meta tags
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        // Remove line breaks
        $text = str_replace(["\r", "\n"], ' ', $text);

        // Remove extra spaces
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /**
     * Generate breadcrumbs structured data
     * 
     * @param array $items
     * @return string
     */
    public static function generateBreadcrumbsSchema($items)
    {
        $itemListElement = [];

        foreach ($items as $index => $item) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement,
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate Organization structured data
     * 
     * @param array $data
     * @return string
     */
    public static function generateOrganizationSchema($data)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'GovernmentOrganization',
            'name' => $data['name'] ?? 'Desa Parangargo',
            'url' => $data['url'] ?? url('/'),
            'logo' => $data['logo'] ?? asset('images/logo.png'),
            'description' => $data['description'] ?? 'Website Resmi Pemerintah Desa Parangargo, Kabupaten Malang',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $data['locality'] ?? 'Parangargo',
                'addressRegion' => $data['region'] ?? 'Jawa Timur',
                'addressCountry' => 'ID',
            ],
        ];

        if (!empty($data['telephone'])) {
            $schema['telephone'] = $data['telephone'];
        }

        if (!empty($data['email'])) {
            $schema['email'] = $data['email'];
        }

        if (!empty($data['social'])) {
            $schema['sameAs'] = $data['social'];
        }

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate Article structured data
     * 
     * @param array $article
     * @return string
     */
    public static function generateArticleSchema($article)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article['title'],
            'description' => $article['description'] ?? '',
            'image' => $article['image'] ?? asset('images/logo.png'),
            'datePublished' => $article['published_at'],
            'dateModified' => $article['updated_at'] ?? $article['published_at'],
            'author' => [
                '@type' => 'Organization',
                'name' => 'Pemerintah Desa Parangargo',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Desa Parangargo',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate keywords from text
     * 
     * @param string $text
     * @param int $limit
     * @return string
     */
    public static function generateKeywords($text, $limit = 10)
    {
        // This is a simple implementation
        // For better results, consider using NLP libraries

        $text = strtolower(strip_tags($text));
        $words = preg_split('/\s+/', $text);

        // Remove common Indonesian stop words
        $stopWords = ['yang', 'dan', 'di', 'dari', 'ini', 'itu', 'dengan', 'untuk', 'pada', 'adalah', 'oleh', 'dalam', 'ke', 'sebagai', 'atau'];

        $words = array_diff($words, $stopWords);
        $words = array_filter($words, function ($word) {
            return strlen($word) > 3;
        });

        $wordCounts = array_count_values($words);
        arsort($wordCounts);

        $keywords = array_slice(array_keys($wordCounts), 0, $limit);

        return implode(', ', $keywords);
    }
}
