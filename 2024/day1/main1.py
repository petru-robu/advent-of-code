
if __name__ == '__main__':
    f = open('input.txt', 'r')

    l1, l2 = [], []
    for line in f:
        l1.append(int(line.split()[0]))
        l2.append(int(line.split()[1]))

    map1, map2 = {}, {}

    for el in l1:
        if el in map1:
            map1[el] += 1
        else:
            map1[el] = 1

    for el in l2:
        if el in map2:
            map2[el] += 1
        else:
            map2[el] = 1

    score = 0

    for nmb in map1:
        ap = 0
        if nmb in map2:
            ap = map2[nmb]
        score += nmb * ap

    print(score)