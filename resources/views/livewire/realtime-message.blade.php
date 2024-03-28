<div>
    <div class="">


         <div>
          <ul>
             @forelse ($messages as $mesg)
             <li class="mt-5 py-4  rounded-sm">
                 <div class="px-8
                 @if ($mesg->user_id == Auth::id())
                 text-right
                 @endif
                 ">
                    <p class=" font-bold text-xl">{{ $mesg->user->name }}</p>
                     <p>{{ $mesg->content }}</p>
                 </div>
             </li>
         @empty
             <li class="mt-5 py-4  rounded-sm"><span class="ml-5">No messages</span></li>
         @endforelse


          </ul>
         </div>
         <div class="mt-10">
            <form wire:submit='sendMessage' wire:keydown.enter="sendMessage">
                <textarea type="text" wire:model="message" class=" block w-full rounded-md bg-indigo-50" rows="7"></textarea>
               <button type="submit" class=" bg-indigo-700 text-white w-full py-3 rounded-md mt-4 hover:bg-indigo-800 ">Send Message</button>
            </form>
        </div>
    </div>
 </div>
