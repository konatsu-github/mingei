@props([ 'rate' => '0', 'num' => '0' ])

<p>
    @if($rate ==='5')
    <style>
        #rating::after {
            width: 100%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='4.5')
    <style>
        #rating::after {
            width: 90%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='4')
    <style>
        #rating::after {
            width: 80%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='3.5')
    <style>
        #rating::after {
            width: 70%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='3')
    <style>
        #rating::after {
            width: 60%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='2.5')
    <style>
        #rating::after {
            width: 50%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='2')
    <style>
        #rating::after {
            width: 40%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='1.5')
    <style>
        #rating::after {
            width: 30%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='1')
    <style>
        #rating::after {
            width: 20%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='0.5')
    <style>
        #rating::after {
            width: 10%;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @elseif($rate ==='0')
    <style>
        #rating::after {
            width: 0;
        }
    </style>
    <span id="rating" class="relative z-0 inline-block whitespace-nowrap text-gray-300 before:content-['★★★★★'] after:content-['★★★★★'] after:absolute after:absolute after:z-1 after:top-0 after:left-0 after:overflow-hidden after:whitespace-nowrap after:text-yellow-400"></span>
    @endif
    <span>({{$num}})</span>
</p>