@extends('layouts.admin')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .edit-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }

    .edit-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4e73df;
    }

    .button-group {
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Satuan</h5>
        <p class="mb-0 text-white-50">Edit data satuan</p>
    </div>

    <div class="edit-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('satuan.update', $satuan->id_satuan) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="satuan">
                            <i class="fas fa-ruler me-2"></i>Satuan
                        </label>
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                            name="satuan" value="{{ $satuan->satuan }}" placeholder="Masukkan Satuan" required>
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('satuan.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
            $(document).ready(func tion () {
                $('#editForm').validate({
                    rules: {
                        satuan: {
                            required: true
                        }
                    },
                    messages: {
                        satuan: {
                            required: "Satuan harus diisi"
                        }
                    },
                    erro rElement: 'div',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-gro up').append(error);
                    },
                    highlight: function (element) {
                        $(el ement).addClass('is-invalid');
                    },
                    unhighlight: function (element) {
                $(element).removeClass('is-invalid');
                    }
                });
            });
    </script>
@endpush