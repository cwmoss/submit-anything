# submit-anything

microservice for posting anything

self hosted form-submit-capture service

### example request

    # endpoint of service: http://acme.com/submit-anything
    # org: acme
    # type: contact
    # POST submission/{org}/send/{type}
    curl --header "Content-Type: application/json" \
      http://acme.com/submit-anything/submission/acme/send/contact \
      -d '{"name":"strange guy","email":"latoya@myspace.com","message":"i like your website, please call back"}'

hmm, ok, now that we can post anything to the bucket, how is it going on from here. i guess we need some user/auth/token magic to let our orgs read and delete submissions.

... and configure stuff, like send-email, send-to-messanger, hook some webs.

... and a vue component for submissions

... and another one for dashboard integration

you see, it's very experimental

i'd like to know, how mysql performs in terms of table with json field vs. new xdevapi/ document store

### managing api

#### create org

	 curl -v -X POST http://acme.com/submit-anything/manage/org/create/acme -H "x-any-admin: secret"

	 => {"name":"acme","password":"XbRQvaE3gm6eL##","api_key":"c56c61505a7abbd9d0d5a975e8d59ec08da0cbc1b3517e3f180978a07eb59a69","types":"{}"}