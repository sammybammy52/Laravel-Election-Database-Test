@extends('layouts.app')

@section('content')
    <div class="bg-dark vh-100">

            <div class="mb-3 col-6">
                <label for="LGA" class="form-label text-white">Select Delta LGAs</label>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="lga">
                    <option selected>Select Delta LGAs</option>

                    @foreach ($lga as $i)
                        <option value="{{ $i->lga_id }}">{{ $i->lga_name }}</option>
                    @endforeach

                </select>

                <div id="total">

                </div>
                <div></div>
                <center><a href="/q3"><button class="btn btn-primary btn-lg mt-4 mb-2">Go to Question 3</button></a></center>
                <center><a href="/"><button class="btn btn-secondary btn-lg">Back to Question 1</button></a></center>
            </div>

        <script>
            $(document).ready(function() {
                $('#lga').on('change', function() {
                    var lga_id = this.value;
                    $.get(`/q2/${lga_id}`, function(data, textStatus, jqXHR) {
                        //$('p').append(data.firstName);
                        console.log(data);

                        if (data.length < 1) {
                            $("#total").html(`<span class="text-white"> No Results </span>`);
                        }
                        else{
                            let total = 0;

                            for (let index = 0; index < data.length; index++) {
                                const element = data[index];
                                let intval = parseInt(element.sum_party_score);

                                total = total + intval;
                            }

                            $("#total").html(`<span class="text-white">Total: ${total} </span>`);

                        }
                    });
                });



            });
        </script>


    </div>
@endsection
