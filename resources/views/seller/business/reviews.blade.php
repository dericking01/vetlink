@extends('layouts.seller.base')

@section('content')
<div class="row align-items-center mb-3">
    <div class="col">
        <h4 class="mb-0" id="followers">
          <span class="page-header-icon">
            <img src="https://6ammart-admin.6amtech.com/public/assets/admin/img/star.png" class="w--26" alt="">
          </span>
             Customers Reviews
        </h4>
    </div>
</div>

<div class="card">
      <div class="card-body">
        <div class="table-responsive scrollbar">
          <table class="table data-table table-bordered table-striped fs--1 mb-0">
            <thead class="bg-200 text-900">
              <tr>
                <th>SN.</th>
                <th>Item</th>
                <th>Reviewer</th>
                <th>Review</th>
                <th>Rating</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody class="list">
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection