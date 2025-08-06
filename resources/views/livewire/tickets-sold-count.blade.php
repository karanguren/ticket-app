<div class="md:w-3/5 w-full">
    <div wire:poll.2000ms="updateTicketsCount">
        <div class="relative pt-1 text-center mb-4">
            <div class="overflow-hidden w-full bg-gray-200 rounded-full dark:bg-gray-700 h-4">
                <div class=" overflow-hidden bg-red-600 text-xs font-medium text-red-100 text-center p-0.5 leading-none rounded-full h-4" style="width:{{ ($soldTicketsCount / $totalTickets) * 100 }}%"> {{ $soldTicketsCount }} de {{ $totalTickets }}</div>
            </div>
            <!-- <strong class="text-white text-[12px] mt-3 mb-3 text-center">{{ $soldTicketsCount }} de {{ $totalTickets }}</strong> -->
             <strong class="text-white text-[12px] mt-3 mb-3 text-center">{{ ($soldTicketsCount / $totalTickets) * 100 }}% del objetivo alcanzado</strong>
            
        </div>
    </div>
</div>
