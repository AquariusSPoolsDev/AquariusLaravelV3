    {{-- POOL STEPS --}}
    <h2 class="pool-creation-steps-title">{{ __('strings.fibreglass_pool_steps_title') }}</h2>
    <div class="pool-creation-grid">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.fibreglass_pool_step_1_title')!!}" />
            <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.fibreglass_pool_step_2_title')!!}" />
            <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.fibreglass_pool_step_3_title')!!}" />
            <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.fibreglass_pool_step_4_title')!!}" />
        </div>
    </div>