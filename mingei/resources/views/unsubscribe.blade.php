<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">退会</h1>
    </x-slot>

    <section>
        <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
            <div class="grid grid-cols-1">
                <div class="w-full max-w-lg mx-auto my-4 bg-white shadow-xl rounded-xl">
                    <div class="p-6 lg:text-left">
                        <h4 class="mt-8 text-2xl font-semibold leading-none tracking-tighter text-neutral-600 lg:text-3xl">退会フォーム</h4>
                        <p class="mt-3 text-base leading-relaxed text-gray-500">
                        <ol class="list-decimal pl-6">
                            <li class="mb-3"><span class="font-bold">アップロードした動画の消失:</span> 退会が完了すると、あなたがアップロードしたすべての動画が永久に削除されます。他のユーザーによる閲覧や評価ができなくなりますので、再度アカウントを作成してアップロードすることはできません。</li>
                            <li class="mb-3"><span class="font-bold">保存したデータの喪失:</span> 退会に伴い、保存したすべてのデータが失われます。これには設定、コメント、お気に入り、履歴などが含まれます。データの復旧は不可能ですので、慎重にお考えください。</li>
                            <li class="mb-3"><span class="font-bold">アカウントのアクセス停止:</span> 退会手続きが完了すると、アカウントへのアクセスが即座に停止されます。ログインやサービスの利用はできなくなりますので、ご注意ください。</li>
                        </ol>
                        これらの影響を十分に理解した上で、退会を申請していただきますようお願い申し上げます。ご不明点やご質問がございましたら、カスタマーサポートまでお気軽にお問い合わせください。<br>
                        続行する場合は「退会」ボタンをクリックしてください。<br>
                        ご利用いただき、ありがとうございました。
                        </p>
                        <div class="mt-6">
                            <form action="{{ route('unsubscribe') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-left text-white transition duration-500 ease-in-out transform bg-red-600 rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">退会</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>