import React from 'react';
import axios from 'axios';
import CrawlerRspVO from './vo/CrawlerRspVO'

class CrawlerApp extends React.Component {

    state = {
        url: '',
        fetchedData: new CrawlerRspVO(),
        content: [],
        isLoading: false
    }

    constructor(props) {
        super(props)
        this.setState({
            fetchedData: new CrawlerRspVO()
        })
    }

    onChangeUrl = (e) => {
        this.setState({
            url: e.target.value
        })
    }

    submit = async () => {

        try {

            const { url } = this.state

            this.setState({
                isLoading: true
            })

            let { data } = await axios.post('/api/v1/fetch-url-data', {
                url
            })

            this.setState({
                url: '',
                fetchedData: new CrawlerRspVO(
                    data.data.screenshot,
                    data.data.title,
                    url,
                    data.data.description,
                    data.data.body
                ),
                isLoading: false
            })
            
        } catch (error) {

            if(error.response.status === 400) {
                alert('網址格式錯誤')
            } else {

                alert('發生錯誤')
                console.error(error)

            }

            this.setState({
                isLoading: false
            })
            
        }
        
    }

    clear = () => {
        this.setState({
            url: '',
            fetchedData: new CrawlerRspVO()
        })
    }

    save = async () => {

        try {
            this.setState({
                isLoading: true
            })

            const { fetchedData } = this.state

            await axios.post('/api/v1/store-url-data', {
                fetchedData
            })

            alert('儲存成功！ 請到後台查看')

            this.setState({
                isLoading: false,
                fetchedData: new CrawlerRspVO()
            })
            
        } catch (error) {

            if(error.response.status === 401) {
                alert('登入才能使用儲存功能')
            } else if (error.response.status === 400) {
                alert('目前無資料')
            } else {
                alert('發生錯誤')
                console.error(error)
            }

            this.setState({
                isLoading: false
            })
            
        }

    }

    render() {

        const { url, fetchedData, isLoading } = this.state
        const isFetchedDataEmpty = JSON.stringify(fetchedData) === JSON.stringify(new CrawlerRspVO())
        return (
            <div>
                <div className="mb-5">
                    <div>
                        <div className="form-group mb-2">
                            <input value={url} disabled={isLoading ? 'disabled' : ''} onChange={this.onChangeUrl} type="text" id="disabledTextInput" className="form-control" placeholder="請輸入網址 https://..." />
                        </div>
                        <div className="d-flex justify-content-center">
                            {
                                isLoading ?
                                <div className="spinner-border text-primary" role="status">
                                    <span className="sr-only"></span>
                                </div>
                                :
                                <>
                                    <button onClick={this.submit} type="submit" className="btn btn-primary me-2">送出</button>
                                    <button onClick={this.clear} type="submit" className="btn btn-primary me-2">清除</button>
                                    <button onClick={this.save} type="submit" className="btn btn-primary">儲存</button>
                                </>
                            }
                        </div>
                    </div>
                </div>
                <div>
                {
                    !isFetchedDataEmpty ? 
                    <table className="table table-striped">      
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Url
                                </th>
                                <td>
                                    { fetchedData.url }
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Screenshot
                                </th>
                                <td>
                                    <img style={{width: '500px'}} src={fetchedData.screenshot} alt="" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Title
                                </th>
                                <td>
                                    <a href={ fetchedData.url } target="_blank">{ fetchedData.title }</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Description
                                </th>
                                <td>
                                    { fetchedData.description }
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Body
                                </th>
                                <td>
                                    { fetchedData.body }
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    :
                    <div></div>
                }    
                
                </div>
                
            </div>
        );
    }
}

export default CrawlerApp;