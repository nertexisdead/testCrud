@aware(['component', 'tableName','isTailwind','isBootstrap'])
@props([])

@if ($this->hasConfigurableAreaFor('before-toolbar'))
    @include($this->getConfigurableAreaFor('before-toolbar'), $this->getParametersForConfigurableArea('before-toolbar'))
@endif

@if (
    $this->filtersAreEnabled() &&
    $this->filtersVisibilityIsEnabled() &&
    $this->hasVisibleFilters() &&
    $this->isFilterLayoutSlideDown()
)
    <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
@endif


@if ($this->hasConfigurableAreaFor('after-toolbar'))
    <div x-cloak x-show="!currentlyReorderingStatus" >
        @include($this->getConfigurableAreaFor('after-toolbar'), $this->getParametersForConfigurableArea('after-toolbar'))
    </div>
@endif
