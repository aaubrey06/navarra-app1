@extends('layouts.customer_layout')

@section('title', 'Account Settings')

@section('contents')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Account Settings</h5>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
                            <div class="max-w-xl">
                                <livewire:profile.update-profile-information-form />
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
                            <div class="max-w-xl">
                                <livewire:profile.update-password-form />
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg">
                            <div class="max-w-xl">
                                <livewire:profile.delete-user-form />
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

