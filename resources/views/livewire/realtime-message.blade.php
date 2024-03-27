<div>
   <div>
        <form action="#" wire:submit='sendMessage'>
            <input type="text" wire:model='message'>
           <button type="submit">Send Message</button>
        </form>

        <div>
         <ul>
            @forelse ($messages as $mesg)
            <li class="mt-5 py-4 bg-slate-100 rounded-sm"><span class="ml-5">{{ $mesg }}</span></li>
        @empty
            <li class="mt-5 py-4 bg-slate-100 rounded-sm"><span class="ml-5">No messages</span></li>
        @endforelse
         </ul>
        </div>
   </div>
</div>
