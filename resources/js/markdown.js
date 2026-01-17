import { marked } from 'marked'
import DOMPurify from 'dompurify'

marked.setOptions({
    breaks: true,
    gfm: true,
})

export function renderMarkdown(md = '') {
    const raw = marked.parse(String(md ?? ''), {async: false})
    return DOMPurify.sanitize(raw)
}
