@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="bg-gray-900 text-white py-20">
        <div class="container text-center">
            <h1 class="display-4 font-bold mb-4">Get in Touch</h1>
            <p class="lead max-w-2xl mx-auto">Have questions? We're here to help.</p>
        </div>
    </div>

    <div class="container py-16">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="bg-white p-8 rounded shadow-sm border">
                    <h3 class="text-2xl font-bold mb-6">Contact Information</h3>

                    <div class="d-flex items-start mb-4">
                        <div class="text-blue-600 text-xl me-3"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h5 class="font-bold">Address</h5>
                            <p class="text-gray-600">123 Business Tower, Salmiya, Global</p>
                        </div>
                    </div>

                    <div class="d-flex items-start mb-4">
                        <div class="text-blue-600 text-xl me-3"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h5 class="font-bold">Email</h5>
                            <p class="text-gray-600">support@JobsPortal.com</p>
                        </div>
                    </div>

                    <div class="d-flex items-start">
                        <div class="text-blue-600 text-xl me-3"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h5 class="font-bold">Phone</h5>
                            <p class="text-gray-600">+965 1234 5678</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="bg-white p-8 rounded shadow-sm border">
                    <h3 class="text-2xl font-bold mb-6">Send us a Message</h3>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label font-bold text-sm">Your Name</label>
                                <input type="text" class="form-control bg-gray-50 border-gray-300" placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-bold text-sm">Your Email</label>
                                <input type="email" class="form-control bg-gray-50 border-gray-300"
                                    placeholder="john@example.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label font-bold text-sm">Subject</label>
                                <input type="text" class="form-control bg-gray-50 border-gray-300"
                                    placeholder="How can we help?">
                            </div>
                            <div class="col-12">
                                <label class="form-label font-bold text-sm">Message</label>
                                <textarea class="form-control bg-gray-50 border-gray-300" rows="5"
                                    placeholder="Write your message here..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary px-6 py-2">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

