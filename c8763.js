#!/Users/tedatsitetag/.nvm/versions/node/v6.9.5/bin/node

/*global $, jQuery, alert, console, angular*/
/**
 *
 * @authors Ted Shiu (ted@sitetag.us)
 * @date    2017-05-02 15:54:23
 * @version $Id$
 */

var http = require('http');

var SlackClient = require('slack-api-client');

var slack = new SlackClient('');

http.get('', (res) => {
  const { statusCode } = res;
  const contentType = res.headers['content-type'];

  let error;
  if (statusCode !== 200) {
    error = new Error(`Request Failed.\n` +
                      `Status Code: ${statusCode}`);
  } else if (!/^application\/json/.test(contentType)) {
    error = new Error(`Invalid content-type.\n` +
                      `Expected application/json but received ${contentType}`);
  }
  if (error) {
    console.error(error.message);
    // consume response data to free up memory
    res.resume();
    return;
  }

  res.setEncoding('utf8');
  let rawData = '';
  res.on('data', (chunk) => { rawData += chunk; });
  res.on('end', () => {
    try {
      const parsedData = JSON.parse(rawData);
      console.log(parsedData);
      var str = '> User : *' + parsedData.data[1].authorName + '* ' + '\n' + '> :star: : *' + parsedData.data[1].rating + '* ' + '\n' + '> comments : *' + parsedData.data[1].comments + '* ';
      slackRest(str);
    } catch (e) {
      console.error(e.message);
    }
  });
}).on('error', (e) => {
  console.error(`Got error: ${e.message}`);
});

function slackRest(data) {
    console.log('slackRest');
    slack.api.chat.postMessage({
      channel: '#c8763',
      username: 'SKY 哥',
      mrkdwn: true,
      text: data
    }, function (err, res) {
      if (err) { throw err; }
      console.log(res);
    });

}

