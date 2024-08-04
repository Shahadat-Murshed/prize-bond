<div class="modal fade" id="createBond" tabindex="-1" aria-labelledby="createBondModalLabel" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-bold" id="createBondModalLabel">Add New Prize Bond</h1>
                <button type="button" class="btn-close cancelButton" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" id="prizeBondForm" method="POST" action="{{ route('prize-bond.store') }}">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col">
                            <div class="form-floating">
                                <select name="amount" id="amount" class="form-control">
                                    <option value="100" selected>100 BDT</option>
                                </select>
                                <label for="amount">Amount (in BDT)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="prefix" name="prefix" placeholder="(prefix)"
                                    value="{{ old('prefix') }}" required />
                                <label for="prefix">Prefix</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="serial" name="serial" placeholder="(serial number)"
                                    value="{{ old('serial') }}" required />
                                <label for="serial">Serial Number</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <x-outline-danger-button class="ms-3 cancelButton" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </x-outline-danger-button>
                <x-primary-button class="ms-3" id="submitButton">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
