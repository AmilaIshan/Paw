<div>
    <button type="button" wire:click="checkAuth" class="mx-4 my-2 w-72 rounded-md border-2 bg-yellow-400 px-4 py-1 text-white hover:bg-green-400 transition {{ $isInCart ? 'bg-blue-400 hover:bg-blue-500' : 'bg-yellow-400 hover:bg-green-400' }}">
        {{ $isInCart ? 'In Cart' : 'Add to Cart' }}
    </button>
</div>
