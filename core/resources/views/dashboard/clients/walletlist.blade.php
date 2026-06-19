@extends('dashboard.layouts.master')
@section('title', 'Client Wallet List')
@section('content')
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe870;</i> Clients Wallet List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>

            @if($wallets->total() > 0)
                {{ Form::open() }}
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th>Email</th>
                            <th>Wallet Name</th>
                            <th>Wallet Address</th>
                            <th>Network</th>
                            <th>Wallet Proof</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallets as $wallet)
                            <tr>
                                <td class="h6">
                                    <small>{{ $wallet->name }} <br /> {{ $wallet->email }}</small>
                                </td>
                                <td>{{ $wallet->wallet_name ?? '-' }}</td>
                                <td>{{ $wallet->wallet_address ?? '-' }}</td>
                                <td>{{ $wallet->wallet_network ?? '-' }}</td>
                                <td>
                                    @if($wallet->wallet_proof)
                                        <img src="{{ asset($wallet->wallet_proof) }}"
                                             alt="Wallet Proof"
                                             width="80"
                                             height="80"
                                             style="cursor:pointer; border-radius:5px;"
                                             data-toggle="modal"
                                             data-target="#imageModal"
                                             data-src="{{ asset($wallet->wallet_proof) }}">
                                    @else
                                        <span>No proof</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <small class="text-muted inline m-t-sm m-b-sm">
                                {{ __('backend.showing') }} {{ $wallets->firstItem() }} - {{ $wallets->lastItem() }}
                                {{ __('backend.of') }}
                                <strong>{{ $wallets->total() }}</strong> {{ __('backend.records') }}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $wallets->links() !!}
                        </div>
                    </div>
                </footer>
                {{ Form::close() }}
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Wallet Proof</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center p-0" style="display: flex; align-items: center; justify-content: center;">
            <img id="modalImage" src="" class="img-fluid" alt="Preview" style="max-width: 500px; height: 450px;">
          </div>
        </div>
      </div>
    </div>
@endsection

@push("after-scripts")
    <script type="text/javascript">
        // Modal image preview
        $(document).ready(function () {
            $('#imageModal').on('show.bs.modal', function (event) {
                let img = $(event.relatedTarget); // clicked image
                let src = img.data('src');
                $('#modalImage').attr('src', src);
            });
        });
    </script>
@endpush
