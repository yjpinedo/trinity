<x-layouts.app title="Dashboard" page="Dashboard" user="Dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Dashboard') }}</h3>
                    {{-- <br>
                    <x-app-config.button type="button" data-toggle="modal" data-target="#modal-default" title="Create"
                        color="outline-light text-danger" icon="fas fa-trash" />
                    <x-app-config.modal idModal="modal-default">
                        <x-slot name="title">
                            {{ __('Register') }}
                        </x-slot>

                        <x-slot name="body">
                            <x-app-config.form submit="submit">
                                <div class="form-group">
                                    <x-app-config.select for="image">
                                        <option value="">Selected</option>
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                    </x-app-config.select>
                                </div>
                                <div class="form-group">
                                    <x-app-config.input />
                                </div>
                                <div class="form-group">
                                    <x-app-config.label value="image" />
                                    <x-app-config.input-file for="image" />
                                </div>
                                <div class="form-group">
                                    <x-slot name="actions">
                                        <div class="d-flex justify-content-between">
                                            <x-app-config.button type="sumit" title="Cancel"
                                            color="secondary" icon="fas fa-ban"/>

                                            <x-app-config.button type="sumit" title="Register"
                                            color="success" icon="fas fa-paper-plane"/>
                                        </div>
                                    </x-slot>
                                </div>
                            </x-app-config.form>
                        </x-slot>

                        <x-slot name="footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </x-slot>
                    </x-app-config.modal> --}}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
