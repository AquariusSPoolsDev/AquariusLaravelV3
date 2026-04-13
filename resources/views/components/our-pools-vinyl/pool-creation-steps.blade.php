{{-- POOL STEPS --}}
<h2 class="pool-creation-steps-title">{{ __('strings.vinyl_pool_steps_title') }}</h2>
<div class="pool-creation-grid">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.vinyl_pool_step_1_title')!!}" />
        <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.vinyl_pool_step_2_title')!!}" />
        <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.vinyl_pool_step_3_title')!!}" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.vinyl_pool_step_4_title')!!}" />
        <x-pool-creation-steps.step-card creation_step_title="{!!__('strings.vinyl_pool_step_5_title')!!}" />
    </div>
</div>