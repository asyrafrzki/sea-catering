@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto py-12 px-4">
  <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Our Meal Plans</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($plans as $plan)
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($plan->image)
          <img src="{{ $plan->image }}" alt="{{ $plan->name }}" class="h-48 w-full object-cover">
        @endif
        <div class="p-6">
          <h3 class="text-xl font-semibold text-green-800">{{ $plan->name }}</h3>
          <p class="mt-2 text-gray-700">{{ Str::limit($plan->description, 100) }}</p>
          <p class="mt-4 font-bold text-green-600">Rp {{ number_format($plan->price,0,',','.') }}</p>
          <button onclick="openDetail({{ $plan->id }})" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">See Details</button>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- Modal -->
<div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>
<div id="modal-container" class="hidden fixed inset-0 z-50 flex items-center justify-center">
  <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 relative max-h-[90vh] overflow-auto">
    <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl">&times;</button>
    <div id="modal-body"></div>
  </div>
</div>

<script>
function openDetail(id) {
  document.getElementById('modal-overlay').classList.remove('hidden');
  document.getElementById('modal-container').classList.remove('hidden');
  document.getElementById('modal-body').innerHTML = '<p class="text-center py-6">Loading...</p>';
  fetch(`/plans/${id}`, {
    headers: {'X-Requested-With': 'XMLHttpRequest'}
  })
    .then(resp => resp.text())
    .then(html => {
      document.getElementById('modal-body').innerHTML = html;
    })
    .catch(() => {
      document.getElementById('modal-body').innerHTML = '<p class="text-center text-red-500 py-6">Error loading details</p>';
    });
}

function closeModal() {
  document.getElementById('modal-overlay').classList.add('hidden');
  document.getElementById('modal-container').classList.add('hidden');
}
document.getElementById('modal-overlay').addEventListener('click', closeModal);
</script>
@endsection
