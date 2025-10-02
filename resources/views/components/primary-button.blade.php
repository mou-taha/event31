<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white w-full  bg-emerald-600 hover:bg-emerald-600/90 focus:ring-4 focus:outline-none focus:ring-emerald-600/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center  mt-2']) }}>
    {{ $slot }}
</button>
  