<?php
if ($Topic->$title_var != "") {
    $title = $Topic->$title_var;
} else {
    $title = $Topic->$title_var2;
}
if ($Topic->$details_var != "") {
    $details = $details_var;
} else {
    $details = $details_var2;
}
$accordion_id = "accordion".@$CatId."-".$Topic->id;
?>
<style>
    .accordion-button:not(.collapsed) {
        color: #45F882 !important;
        background-color: transparent !important;
        box-shadow: none;
    }

    .accordion-card.style2 .accordion-button::after {
        background-color: #0b0e13 0b0e13 !important;
        /* black when collapsed */
    }

    .accordion-card.style2 .accordion-button:not(.collapsed)::after {
        background-color: #45F882 !important;
        /* green when expanded */
    }

    .accordion-card.style2 {}

    .accordion-card.style2 {
        position: relative;
        /* make pseudo-elements relative to card */
    }

    .accordion-card.style2:before {
        content: '';
        position: absolute;
        top: 0;
        /* line at the top */
        bottom: 0;
        /* line at the bottom */
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--black-color2);
    }

    .accordion-card.style2:after {
        display: none;
    }
</style>

<!--<div class="mb-2">-->
<!--    <div class="accordion-item">-->
<!--        <h2 class="accordion-header" id="{{ $accordion_id }}-link">-->
<!--            <button class="accordion-button collapsed" type="button"-->
<!--                    data-bs-toggle="collapse"-->
<!--                    data-bs-target="#{{ $accordion_id }}-topic"-->
<!--                    aria-expanded="false"-->
<!--                    aria-controls="{{ $accordion_id }}-topic">-->
<!--                @if($Topic->icon !="")-->
<!--                    <i class="fa {!! $Topic->icon !!} "></i>&nbsp;-->
<!--                @endif-->
<!--                {{ $title }}-->
<!--            </button>-->
<!--        </h2>-->
<!--        <div id="{{ $accordion_id }}-topic" class="accordion-collapse collapse"-->
<!--             aria-labelledby="{{ $accordion_id }}-link">-->
<!--            <div class="accordion-body">-->
<!--                {!! $Topic->$details !!}-->

<!--                {{--Additional Feilds--}}-->
<!--                @include("frontEnd.topic.fields",["cols"=>12,"Fields"=>@$Topic->webmasterSection->customFields->where("in_listing",true)])-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="accordion-card style2 mb-2">
    <div class="accordion-header" id="{{ $accordion_id }}-link">
        <button class="accordion-button title collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#{{ $accordion_id }}-topic" aria-expanded="false" aria-controls="{{ $accordion_id }}-topic">
            @if ($Topic->icon != '')
                <i class="fa {!! $Topic->icon !!}"></i>&nbsp;
            @endif
            {{ $title }}
        </button>
    </div>
    <div id="{{ $accordion_id }}-topic" class="accordion-collapse collapse" aria-labelledby="{{ $accordion_id }}-link"
        data-bs-parent="#accordion-{{ @$CatId }}"> {{-- 🔑 Added this --}}
        <div class="accordion-body desc">
            {!! $Topic->$details !!}

            {{-- Additional Fields --}}
            @include('frontEnd.topic.fields', [
                'cols' => 12,
                'Fields' => @$Topic->webmasterSection->customFields->where('in_listing', true),
            ])
        </div>
    </div>
</div>
