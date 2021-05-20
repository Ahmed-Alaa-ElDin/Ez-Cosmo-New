@if ($sortBy ?? '' !== $field)
    <i class="text-blue-400 fas fa-sort"></i>
@elseif ($sortDirection == 'DESC')
    <i class="text-white fas fa-sort-up"></i>
@else
    <i class="text-white fas fa-sort-down"></i>
@endif
