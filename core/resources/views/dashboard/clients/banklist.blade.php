@extends('dashboard.layouts.master')
@section('title', 'Client Bank List')
@section('content')
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe7fe;</i> Clients Bank List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>

            @if($Banks->total() > 0)
                {{ Form::open() }}
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th>Email</th>
                            <th>Holder Name</th>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>IFSC Code</th>
                            <th>Swift Code</th>
                            <th>Bank Proof</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Banks as $bank)
                            <tr>
                                <td class="h6"><small>{{ $bank->name }} <br /> {{ $bank->email }}</small></td>
                                <td>{{ $bank->account_holder }}</td>
                                <td>{{ $bank->bank_name }}</td>
                                <td>{{ $bank->account_number }}</td>
                                <td>{{ $bank->ifsccode }}</td>
                                <td>{{ $bank->swift_code }}</td>
                                <td>
                                    @if($bank->bank_proof)
                                        <img src="{{ asset($bank->bank_proof) }}"
                                             alt="Bank Proof"
                                             width="80"
                                             height="80"
                                             style="cursor:pointer; border-radius:5px;"
                                             data-toggle="modal"
                                             data-target="#imageModal"
                                             data-src="{{ asset($bank->bank_proof) }}">
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
                                {{ __('backend.showing') }} {{ $Banks->firstItem() }} - {{ $Banks->lastItem() }}
                                {{ __('backend.of') }} <strong>{{ $Banks->total() }}</strong> {{ __('backend.records') }}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $Banks->links() !!}
                        </div>
                    </div>
                </footer>
                {{ Form::close() }}
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Bank Proof</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center p-0">
            <img id="modalImage" src="" class="img-fluid" alt="Preview" style="max-width:500px;max-height:500px;">
          </div>
        </div>
      </div>
    </div>
@endsection

@push("after-scripts")
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });

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
