<div id="auth-login" class="flex min-screen h-screen">
    <div class="flex-1 bg-blue-300">

    </div>
    <div class="w-[400px] flex justify-center items-center">
        <form action="" class="w-full p-5" wire:submit.prevent='login'>
            {{ $this->form }}
            <div class="mt-5">
                <button type="submit" class="bg-green-300 rounded-md p-3 w-full">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
