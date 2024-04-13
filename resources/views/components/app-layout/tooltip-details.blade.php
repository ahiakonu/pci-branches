 <!-- tooltip area -->
 @props(['tooltip_label'])
 <div class="absolute top-auto bottom-full mb-3" x-cloak x-show.transition.origin.top="tooltips">
     <div class="z-40 w-30 p-3 -mb-1 text-sm leading-tight text-white bg-black rounded-lg shadow-lg text-center">
         {{ $tooltip_label }}
     </div>
     <div class="absolute transform -rotate-45 p-1 w-1 bg-black bottom-0 -mb-2 ltr:ml-6 rtl:mr-6">
     </div>
 </div>
