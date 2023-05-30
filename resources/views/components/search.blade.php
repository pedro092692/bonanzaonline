@props(['size' => 100, 'color' => 'gray'])

@php
    switch($color){
        case 'gray':
            $col = "#65797F";
        break;
        case 'white':
            $col = "#FFFFFF";
        break;
        case 'green':
            $col = "#359E44";
        break;

        default:
            $col = "#65797F";
        break;
    }
@endphp

<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="{{$size}}" height="{{$size}}" viewBox="0,0,256,256"
    style="fill:#000000;">
    <g fill="{{$col}}" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
        stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <g transform="scale(5.12,5.12)">
            <path
                d="M21,3c-9.39844,0 -17,7.60156 -17,17c0,9.39844 7.60156,17 17,17c3.35547,0 6.46094,-0.98437 9.09375,-2.65625l12.28125,12.28125l4.25,-4.25l-12.125,-12.09375c2.17969,-2.85937 3.5,-6.40234 3.5,-10.28125c0,-9.39844 -7.60156,-17 -17,-17zM21,7c7.19922,0 13,5.80078 13,13c0,7.19922 -5.80078,13 -13,13c-7.19922,0 -13,-5.80078 -13,-13c0,-7.19922 5.80078,-13 13,-13z">
            </path>
        </g>
    </g>
</svg>
