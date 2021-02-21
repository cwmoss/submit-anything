# submit-anything

microservice for posting anything

self hosted form-submit-capture service

### example request

    # endpoint of service: http://acme.com/submit-anything
    # org: acme
    # type: contact
    # POST {org}/send/{type}
    curl --header "Content-Type: application/json" \
      http://acme.com/submit-anything/submission/acme/send/contact \
      -d '{"name":"strange guy","email":"latoya@myspace.com","message":"i like your website, please call back"}'
