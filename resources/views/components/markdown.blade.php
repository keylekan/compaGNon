@props([
    'value',
])

<div
    {{ $attributes->class("prose max-w-none prose-headings:font-semibold prose-a:text-[--color-bronze] prose-blockquote:border-[--color-bronze]") }}
    x-data="{
        html: '',
        render(v) { this.html = window.renderMarkdown(v) },
        init() {
            this.render({{ $value }})
            this.$watch(() => ({{ $value }}), (v) => this.render(v))
        }
    }"
    x-html="html"
></div>
