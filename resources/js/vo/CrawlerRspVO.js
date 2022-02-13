class CrawlerRspVO {
    constructor(
        screenshot = '',
        title = '',
        url = '',
        description = '',
        body = ''
    ) {
        this.screenshot = screenshot
        this.title = title
        this.url = url
        this.description = description
        this.body = body
    }
}

export default CrawlerRspVO;