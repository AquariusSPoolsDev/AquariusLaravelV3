@php
    /**
     * FAQPage schema built from the exact strings shown on the FAQ page, so the
     * markup always matches the visible answers in the current language.
     *
     * @var array<string, list<string>> $questions question key => answer string keys, in page order
     */
    $questions = [
        'faq_choose_concrete' => [
            'faq_choose_concrete_answer',
            'faq_choose_concrete_answer_benefit_1', 'faq_choose_concrete_answer_benefit_1_detail',
            'faq_choose_concrete_answer_benefit_2', 'faq_choose_concrete_answer_benefit_2_detail',
            'faq_choose_concrete_answer_benefit_3', 'faq_choose_concrete_answer_benefit_3_detail',
            'faq_choose_concrete_answer_benefit_4', 'faq_choose_concrete_answer_benefit_4_detail',
            'faq_choose_concrete_answer_benefit_5', 'faq_choose_concrete_answer_benefit_5_detail',
        ],
        'faq_coping' => [
            'faq_coping_answer_1',
            'faq_coping_answer_2',
        ],
        'faq_popular_pool_size' => [
            'faq_popular_pool_size_answer_1',
            'faq_popular_pool_size_answer_2',
            'faq_popular_pool_size_answer_list_1', 'faq_popular_pool_size_answer_list_2', 'faq_popular_pool_size_answer_list_3',
            'faq_popular_pool_size_answer_list_4', 'faq_popular_pool_size_answer_list_5',
            'faq_popular_pool_size_answer_3',
        ],
        'faq_pool_safe_kids' => [
            'faq_pool_safe_kids_answer_1',
            'faq_pool_safe_kids_answer_2',
            'faq_pool_safe_kids_answer_tips_1', 'faq_pool_safe_kids_answer_tips_1_detail',
            'faq_pool_safe_kids_answer_tips_2', 'faq_pool_safe_kids_answer_tips_2_detail',
            'faq_pool_safe_kids_answer_tips_3', 'faq_pool_safe_kids_answer_tips_3_detail',
            'faq_pool_safe_kids_answer_tips_4', 'faq_pool_safe_kids_answer_tips_4_detail',
            'faq_pool_safe_kids_answer_tips_5',
            'faq_pool_safe_kids_answer_tips_rule_1', 'faq_pool_safe_kids_answer_tips_rule_2', 'faq_pool_safe_kids_answer_tips_rule_3',
            'faq_pool_safe_kids_answer_tips_6', 'faq_pool_safe_kids_answer_tips_6_detail',
        ],
        'faq_different_material_avail' => [
            'faq_different_material_avail_answer_1',
            'faq_different_material_avail_link_text',
            'faq_different_material_avail_answer_2',
        ],
        'faq_kind_maintenance' => [
            'faq_kind_maintenance_answer_1',
            'faq_kind_maintenance_answer_steps_1', 'faq_kind_maintenance_answer_steps_1_detail',
            'faq_kind_maintenance_answer_steps_2', 'faq_kind_maintenance_answer_steps_2_detail',
            'faq_kind_maintenance_answer_steps_3', 'faq_kind_maintenance_answer_steps_3_detail',
            'faq_kind_maintenance_answer_steps_4', 'faq_kind_maintenance_answer_steps_4_detail',
            'faq_kind_maintenance_answer_2_1',
            'faq_kind_maintenance_answer_2_link_text',
            'faq_kind_maintenance_answer_2_2',
        ],
    ];

    $plainText = fn (string $key): string => trim(preg_replace('/\s+/', ' ', strip_tags(__('strings.'.$key))));

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'inLanguage' => str_replace('_', '-', app()->getLocale()),
        'mainEntity' => collect($questions)->map(fn (array $answerKeys, string $questionKey): array => [
            '@type' => 'Question',
            'name' => $plainText($questionKey),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => collect($answerKeys)->map($plainText)->filter()->implode(' '),
            ],
        ])->values()->all(),
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_PRETTY_PRINT) !!}
</script>
