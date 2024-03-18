<div>
    <input type="text" wire:model="title" placeholder="相册标题" />

    <input type="file" wire:model="photos" multiple />

    @if ($photos)
        <div class="flex flex-wrap">
            @foreach ($photos as $key => $photo)
                <div class="relative" wire:key="photo-{{ $key }}">
                    <img src="{{ $photo->temporaryUrl() }}" alt="照片" class="w-32 h-32 object-cover" draggable="true" />
                    <input type="hidden" wire:model="photoOrders.{{ $key }}" />
                </div>
            @endforeach
        </div>
    @endif

    <button wire:click="save">保存相册</button>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('Sortable', () => ({
            init() {
                this.$el.querySelectorAll('.draggable').forEach(img => {
                    img.addEventListener('dragstart', this.handleDragStart);
                    img.addEventListener('dragover', this.handleDragOver);
                    img.addEventListener('drop', this.handleDrop);
                    img.addEventListener('dragend', this.handleDragEnd);
                });
            },
            handleDragStart(e) {
                e.dataTransfer.setData('text/plain', e.target.getAttribute('data-key'));
            },
            handleDragOver(e) {
                e.preventDefault();
            },
            handleDrop(e) {
                e.preventDefault();
                const srcKey = e.dataTransfer.getData('text/plain');
                const dstKey = e.target.getAttribute('data-key');
                this.$wire.movePhoto(srcKey, dstKey);
            },
            handleDragEnd(e) {
                // 清理样式或其他操作
            },
        }));
    });
</script>