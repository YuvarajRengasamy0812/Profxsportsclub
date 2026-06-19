@extends('crm.layouts.master')
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

@section('content')

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-10">
        <div class="max-w-7xl mx-auto space-y-10">

            <!-- HEADER -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">
                        Transactions
                    </h2>
                    
                </div>
            </div>

            <!-- FILTER BAR -->
            <form id="filterForm" class="bg-white/70 backdrop-blur-xl border border-slate-200
                 rounded-2xl px-6 py-4 shadow-xl">

                <div class="flex flex-wrap gap-4 items-center">

                    <!-- SEARCH -->
                    <div class="flex-1 min-w-[100px]">
    <input type="text"
           name="search"
           id="searchInput"
           value="{{ request('search') }}"
           placeholder="Search payment ID, purpose, method..."
           class="block w-[400px] grow bg-white border border-slate-300 rounded-xl 
                  py-2 px-3 text-base text-gray-900 placeholder-gray-400 
                  focus:border-[#e85a3c] focus:ring-1 focus:ring-[#e85a3c] sm:text-sm"
    >
</div>


                    <!-- FROM DATE -->
                    <div>
                        <input type="date" name="start_date" id="startDate" value="{{ request('start_date') }}"
                            class="rounded-xl border-slate-300">
                    </div>

                    <!-- TO DATE -->
                    <div>
                        <input type="date" name="end_date" id="endDate" value="{{ request('end_date') }}"
                            class="rounded-xl border-slate-300">
                    </div>

                    <!-- BUTTON -->
                    <div>
                        <button type="submit" class="px-8 py-3 bg-[#e85a3c] text-white
                           rounded-xl font-black text-xs uppercase
                           hover:bg-slate-900 transition">
                            Filter
                        </button>
                    </div>

                </div>

            </form>


            <!-- TRANSACTION TABLE -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

                <!-- Scroll Wrapper -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">

                        <!-- TABLE HEAD -->
                        <thead class="bg-slate-100 sticky top-0 z-10">
                            <tr class="text-xs uppercase text-slate-600 tracking-wider">
                                <th class="px-6 py-4 text-left">Payment ID</th>
                                <th class="px-6 py-4 text-left">Type</th>
                                <th class="px-6 py-4 text-left">Method</th>
                                <th class="px-6 py-4 text-left">Date</th>
                                <th class="px-6 py-4 text-right">Amount</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>

                        <!-- TABLE BODY -->
                        <tbody class="divide-y divide-slate-200">

                            @forelse($transactions as $t)
                                <tr class="hover:bg-slate-50 transition duration-200 group">

                                    <!-- PAYMENT ID -->
                                    <td class="px-6 py-4 font-bold text-slate-900 whitespace-nowrap">
                                        {{ $t->payment_log_id }}
                                    </td>

                                    <!-- PURPOSE -->
                                    <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                        {{ $t->trans_purpose }}
                                    </td>

                                    <!-- METHOD -->
                                    <td class="px-6 py-4 text-slate-700 whitespace-nowrap">
                                        {{ $t->trans_method }}
                                    </td>

                                    <!-- DATE -->
                                    <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($t->trans_date)->format('d M Y') }}
                                    </td>

                                    <!-- AMOUNT -->
                                    <td class="px-6 py-4 text-right font-black text-slate-900 whitespace-nowrap">
                                        <!--{{ $t->trans_currency }}-->
                                        $
                                        {{ number_format($t->trans_amount, 2) }}
                                    </td>

                                    <!-- STATUS -->
                                    @php
$statusClasses = [
    'success' => 'bg-green-100 text-green-700',
    'pending' => 'bg-yellow-100 text-yellow-700',
    'failed'  => 'bg-red-100 text-red-700',
    'rejected'=> 'bg-red-100 text-red-700', // added rejected
    'approved'=> 'bg-green-100 text-green-700',
];
$class = $statusClasses[strtolower($t->trans_status)] ?? 'bg-gray-100 text-gray-700';
@endphp

<td class="px-6 py-4 text-center whitespace-nowrap">
    <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-black {{ $class }}">
        {{ strtoupper($t->trans_status) }}
    </span>
</td>

                                </tr>

                                <!-- ADMIN REMARK ROW -->
                                <!--@if($t->trans_adminremark)-->
                                <!--    <tr class="bg-slate-50">-->
                                <!--        <td colspan="6" class="px-6 pb-4">-->
                                <!--            <div class="mt-2 text-xs text-slate-600">-->
                                <!--                <span class="font-bold uppercase text-slate-500">-->
                                <!--                    Admin Remark:-->
                                <!--                </span>-->
                                <!--                {{ $t->trans_adminremark }}-->
                                <!--            </div>-->
                                <!--        </td>-->
                                <!--    </tr>-->
                                <!--@endif-->

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 font-semibold">
                                        No transactions found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGINATION -->
            <div class="pt-6">
                {{ $transactions->links() }}
            </div>


        </div>
    </div>

@endsection