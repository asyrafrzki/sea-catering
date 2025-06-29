@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4">
  <h2 class="text-4xl font-bold text-center text-green-700 mb-12 animate-fade-in">
    Explore Our Premium Meal Plans
  </h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($plans as $plan)
      <div class="bg-white rounded-3xl shadow-xl overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out group">
        @if ($plan->image)
          <div class="overflow-hidden">
            <img 
              src="{{ $plan->image }}" 
              alt="{{ $plan->name }}" 
              class="h-56 w-full object-cover group-hover:scale-110 transition-transform duration-500"
            >
          </div>
        @endif

        <div class="p-6 space-y-3">
          <h3 class="text-2xl font-bold text-green-800">
            {{ $plan->name }}
          </h3>

          <p class="text-gray-600">
            {{ Str::limit($plan->description, 90) }}
          </p>

          <p class="text-lg font-semibold text-green-600">
            Rp {{ number_format($plan->price, 0, ',', '.') }},00 / meal
          </p>

          <button 
            onclick="openDetail({{ $plan->id }})"
            class="w-full px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.03] transition-all duration-300"
          >
            See Details
          </button>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- Modal Overlay -->
<div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-40 backdrop-blur-sm"></div>

<!-- Modal Container -->
<div id="modal-container" class="hidden fixed inset-0 z-50 flex items-center justify-center">
  <div id="modal-content" class="bg-white rounded-2xl shadow-2xl max-w-xl w-full p-6 relative max-h-[90vh] overflow-auto scale-90 opacity-0 transition-all duration-300">
    <button 
      onclick="closeModal()" 
      class="absolute top-3 right-4 text-gray-500 hover:text-red-600 text-3xl font-bold"
    >
      &times;
    </button>
    <div id="modal-body" class="animate-fade-in"></div>
  </div>
</div>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }

  .animate-fade-in {
    animation: fadeIn 0.4s ease-out forwards;
  }
</style>

<script>
  function openDetail(id) {
    const overlay = document.getElementById('modal-overlay');
    const container = document.getElementById('modal-container');
    const content = document.getElementById('modal-content');
    const body = document.getElementById('modal-body');

    overlay.classList.remove('hidden');
    container.classList.remove('hidden');
    content.classList.remove('scale-90', 'opacity-0');
    content.classList.add('scale-100', 'opacity-100');

    body.innerHTML = '<p class="text-center py-6">Loading...</p>';

    fetch(`/plans/${id}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(resp => resp.text())
      .then(html => {
        body.innerHTML = html;
      })
      .catch(() => {
        body.innerHTML = '<p class="text-center text-red-500 py-6">Error loading details</p>';
      });
  }

  function closeModal() {
    const overlay = document.getElementById('modal-overlay');
    const container = document.getElementById('modal-container');
    const content = document.getElementById('modal-content');

    overlay.classList.add('hidden');
    container.classList.add('hidden');
    content.classList.add('scale-90', 'opacity-0');
  }

  document.getElementById('modal-overlay').addEventListener('click', closeModal);
</script>
@endsection
