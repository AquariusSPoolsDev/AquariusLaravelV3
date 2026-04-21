{{-- POOL STEPS --}}
<div class="pool-creation-grid lg:col-span-1">
    <div class="flex flex-col">
        <x-pool-creation-steps.step-card :step_number="1" creation_step_title="{!!__('strings.concrete_pool_step_1_title')!!}" />
        <x-pool-creation-steps.step-card :step_number="2" creation_step_title="{!!__('strings.concrete_pool_step_2_title')!!}" />
        <x-pool-creation-steps.step-card :step_number="3" creation_step_title="{!!__('strings.concrete_pool_step_3_title')!!}" />
        <x-pool-creation-steps.step-card :step_number="4" creation_step_title="{!!__('strings.concrete_pool_step_4_title')!!}" />
        <x-pool-creation-steps.step-card :step_number="5" creation_step_title="{!!__('strings.concrete_pool_step_5_title')!!}" :is_last="true" />
    </div>
</div>
